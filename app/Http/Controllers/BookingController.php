<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventTicket;
use App\Models\Registration;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        try {
            DB::beginTransaction();

            $ticket = EventTicket::findOrFail($request->ticket_id);

            // 1. Cek Kuota
            if ($ticket->quota <= 0) {
                return back()->with('error', 'Maaf, kuota tiket ini sudah habis.');
            }

            // 2. Buat Registrasi
            Registration::create([
                'user_id'   => Auth::id(),
                'event_id'  => $request->event_id,
                'ticket_id' => $request->ticket_id,
                'status'    => 'Registered',
            ]);

            // 3. Kurangi Kuota Tiket
            $ticket->decrement('quota');

            // 4. Catat Log Aktivitas
            ActivityLog::create([
                'user_id' => Auth::id(),
                'action' => 'Pemesanan Tiket',
                'description' => Auth::user()->name . ' melakukan pemesanan tiket "' . $ticket->name . '" untuk event "' . $ticket->event->title . '".',
            ]);

            DB::commit();

            return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dipesan! Selamat menikmati event.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal memesan tiket: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan tiket yang dimiliki user.
     */
    public function index()
    {
        $registrations = Registration::with(['event', 'ticket'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.tickets.index', compact('registrations'));
    }
}
