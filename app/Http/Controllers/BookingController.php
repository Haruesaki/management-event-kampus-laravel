<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Registration;
use App\Models\ActivityLog;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

use Midtrans\Transaction;

class BookingController extends Controller
{
    /**
     * Menangani proses pemesanan tiket.
     */
    public function store(Request $request)
    {
        $request->validate([
            'event_id'  => 'required|exists:events,id',
            'ticket_id' => 'required|exists:event_tickets,id',
        ]);

        // 1. Cek apakah user sudah terdaftar di event ini
        $existingRegistration = Registration::where('user_id', Auth::id())
            ->where('event_id', $request->event_id)
            ->first();

        if ($existingRegistration) {
            // Jika sudah terdaftar, cek status pembayarannya
            if ($existingRegistration->payment && $existingRegistration->payment->payment_status === 'Pending') {
                return redirect()->route('tickets.index')->with('error', 'Anda sudah memiliki pesanan yang menunggu pembayaran.');
            } elseif ($existingRegistration->payment && $existingRegistration->payment->payment_status === 'Success') {
                return redirect()->route('tickets.index')->with('error', 'Anda sudah terdaftar di event ini.');
            } elseif (!$existingRegistration->payment) {
                // Untuk tiket gratis yang sudah terdaftar
                return redirect()->route('tickets.index')->with('error', 'Anda sudah terdaftar di event ini.');
            }
            // Jika Rejected, kita izinkan buat pendaftaran baru? 
            // Sebaiknya kita hapus pendaftaran lama yang rejected agar tidak menumpuk, 
            // tapi untuk amannya kita biarkan user buat pendaftaran baru saja.
        }

        try {
            DB::beginTransaction();

            $ticket = EventTicket::findOrFail($request->ticket_id);

            // 2. Cek Kuota
            if ($ticket->quota <= 0) {
                return back()->with('error', 'Maaf, kuota tiket ini sudah habis.');
            }

            // 3. Buat Registrasi
            $registration = Registration::create([
                'user_id'   => Auth::id(),
                'event_id'  => $request->event_id,
                'ticket_id' => $request->ticket_id,
                'status'    => 'Registered',
            ]);

            // 4. Kurangi Kuota Tiket
            $ticket->decrement('quota');

            // 5. Catat Log Aktivitas Awal
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Pemesanan Tiket',
                'description' => Auth::user()->name . ' melakukan pemesanan tiket "' . $ticket->name . '" untuk event "' . $ticket->event->title . '".',
            ]);

            // 6. Cek jika tiket berbayar
            if ($ticket->type === 'Berbayar') {
                // Buat Order ID Unik untuk menghindari tabrakan di Midtrans
                $uniqueOrderId = 'TRX-' . Auth::id() . '-' . time() . '-' . rand(100, 999);

                // Buat record Payment
                $payment = Payment::create([
                    'registration_id' => $registration->id,
                    'order_id' => $uniqueOrderId,
                    'amount' => $ticket->price,
                    'payment_status' => 'Pending',
                    'expired_at' => now()->addMinutes(30),
                ]);

                // Konfigurasi Midtrans
                Config::$serverKey = config('services.midtrans.server_key');
                Config::$isProduction = config('services.midtrans.is_production');
                Config::$isSanitized = config('services.midtrans.is_sanitized');
                Config::$is3ds = config('services.midtrans.is_3ds');

                $params = [
                    'transaction_details' => [
                        'order_id' => $uniqueOrderId,
                        'gross_amount' => (int) $payment->amount,
                    ],
                    'customer_details' => [
                        'first_name' => Auth::user()->name,
                        'email' => Auth::user()->email,
                    ],
                    'item_details' => [
                        [
                            'id' => $ticket->id,
                            'price' => (int) $ticket->price,
                            'quantity' => 1,
                            'name' => 'Tiket: ' . substr($ticket->name, 0, 40),
                        ]
                    ]
                ];

                $snapToken = Snap::getSnapToken($params);

                // Simpan snap token ke database
                $payment->update(['snap_token' => $snapToken]);

                DB::commit();

                return view('user.payment.checkout', compact('registration', 'payment', 'snapToken'));
            }

            DB::commit();

            return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dipesan! Selamat menikmati event.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Kembalikan error yang lebih spesifik jika dari Midtrans
            $errorMessage = $e->getMessage();
            if (str_contains($errorMessage, '406')) {
                $errorMessage = 'Kesalahan sistem pembayaran (Duplicate ID). Silakan coba lagi dalam beberapa saat.';
            }
            return back()->with('error', 'Gagal memesan tiket: ' . $errorMessage);
        }
    }

    /**
     * Menampilkan tiket yang dimiliki user.
     */
    public function index()
    {
        // Konfigurasi Midtrans untuk sinkronisasi status
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = config('services.midtrans.is_production');

        // 1. Ambil semua registrasi user ini
        $allRegistrations = Registration::with(['event', 'ticket', 'payment'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // 2. Sinkronisasi status dari API Midtrans (Solusi jika callback gagal/tidak sampai ke localhost)
        foreach ($allRegistrations as $reg) {
            if ($reg->payment && $reg->payment->payment_status === 'Pending') {
                try {
                    // Tarik status terbaru langsung dari Midtrans
                    $status = Transaction::status($reg->payment->order_id);
                    $transactionStatus = $status->transaction_status;

                    if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                        $reg->payment->update(['payment_status' => 'Success']);
                        $reg->payment->payment_status = 'Success'; // Update objek di memori untuk tampilan
                        
                        ActivityLog::create([
                            'user_id' => Auth::id(),
                            'action' => 'Pembayaran Tiket (Sync)',
                            'description' => 'Status pembayaran disinkronkan secara otomatis untuk event "' . $reg->event->title . '".',
                        ]);
                    } elseif (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {
                        $reg->payment->update(['payment_status' => 'Rejected']);
                        $reg->payment->payment_status = 'Rejected';
                    }
                } catch (\Exception $e) {
                    // Jika data tidak ditemukan di Midtrans (belum mulai bayar), abaikan
                }

                // Cek kadaluarsa berdasarkan sistem lokal jika masih pending
                if ($reg->payment->payment_status === 'Pending' && now()->greaterThan($reg->payment->expired_at)) {
                    $reg->payment->update(['payment_status' => 'Rejected']);
                    $reg->payment->payment_status = 'Rejected';
                }
            }
        }

        // 3. Klasifikasi: Tiket Aktif (Berhasil atau Gratis)
        $activeTickets = $allRegistrations->filter(function ($reg) {
            return $reg->ticket->type === 'Gratis' || 
                   ($reg->payment && $reg->payment->payment_status === 'Success');
        });

        // 4. Klasifikasi: Semua Transaksi
        $transactions = $allRegistrations;

        return view('user.tickets.index', compact('activeTickets', 'transactions'));
    }

    /**
     * Mengunduh e-ticket dalam format PDF.
     */
    public function download($id)
    {
        $registration = Registration::with(['event', 'ticket', 'user', 'payment'])
            ->where('user_id', Auth::id())
            ->findOrFail($id);

        // Pastikan tiket sudah lunas atau gratis
        if ($registration->ticket->type === 'Berbayar' && (!$registration->payment || $registration->payment->payment_status !== 'Success')) {
            return back()->with('error', 'Pembayaran belum diselesaikan.');
        }

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('user.tickets.pdf', compact('registration'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('E-Ticket-' . $registration->id . '.pdf');
    }
}
