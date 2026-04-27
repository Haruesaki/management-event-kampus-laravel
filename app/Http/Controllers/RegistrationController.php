<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RegistrationsExport;

class RegistrationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'event_id' => ['required', 'exists:events,id'],
        ]);

        $event = Event::findOrFail($request->event_id);

        // Cek apakah sudah terdaftar
        $alreadyRegistered = Registration::where('user_id', Auth::id())
            ->where('event_id', $event->id)
            ->exists();

        if ($alreadyRegistered) {
            return back()->with('error', 'Kamu sudah terdaftar di event ini.');
        }

        // Cek kuota
        $registered = Registration::where('event_id', $event->id)
            ->where('status', 'Registered')
            ->count();

        if ($registered >= $event->quota) {
            return back()->with('error', 'Maaf, kuota event ini sudah penuh.');
        }

        // Buat registrasi
        $registration = Registration::create([
            'user_id'  => Auth::id(),
            'event_id' => $event->id,
            'status'   => 'Registered',
        ]);

        // Jika event berbayar, buat payment pending
        if ($event->ticket_price > 0) {
            Payment::create([
                'registration_id' => $registration->id,
                'amount'          => $event->ticket_price,
                'payment_status'  => 'Pending',
                'expired_at'      => now()->addMinutes(5), // 5 menit untuk bayar
            ]);

            return redirect()->route('payment.show', $registration->id)
                ->with('success', 'Registrasi berhasil! Silakan selesaikan pembayaran dalam 5 menit.');
        }

        // Event gratis — langsung terdaftar
        return redirect()->route('tickets.index')
            ->with('success', 'Pendaftaran berhasil! Event ini gratis.');
    }

    public function payment(Registration $registration)
    {
        $this->authorize('view', $registration);

        $payment = $registration->payment;

        // Cek apakah payment sudah expired
        if ($payment && $payment->payment_status === 'Pending' && now()->gt($payment->expired_at)) {
            $payment->update(['payment_status' => 'Rejected']);
            $registration->update(['status' => 'Cancelled']);
            return redirect()->route('events.show', $registration->event_id)
                ->with('error', 'Waktu pembayaran habis. Silakan daftar ulang.');
        }

        return view('payment.show', compact('registration', 'payment'));
    }

    public function process(Request $request, Registration $registration)
    {
        $this->authorize('view', $registration);

        $payment = $registration->payment;

        if (!$payment || $payment->payment_status !== 'Pending') {
            return back()->with('error', 'Pembayaran tidak valid.');
        }

        if (now()->gt($payment->expired_at)) {
            $payment->update(['payment_status' => 'Rejected']);
            $registration->update(['status' => 'Cancelled']);
            return redirect()->route('events.index')
                ->with('error', 'Waktu pembayaran habis.');
        }

        // Simulasi pembayaran berhasil
        $payment->update([
            'payment_status' => 'Success',
            'payment_method' => $request->payment_method ?? 'Transfer',
        ]);

        return redirect()->route('tickets.index')
            ->with('success', 'Pembayaran berhasil! Tiket kamu sudah aktif.');
    }

    public function export()
    {
        return Excel::download(new RegistrationsExport, 'registrations.xlsx');
    }
}