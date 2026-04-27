<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
         $roles = \App\Models\Role::all();
        $activeTickets = Registration::with(['event', 'payment'])
            ->where('user_id', Auth::id())
            ->where('status', 'Registered')
            ->whereHas('payment', fn($q) => $q->where('payment_status', 'Success'))
            ->orWhere(function ($q) {
                // Event gratis tidak punya payment, tapi tetap registered
                $q->where('user_id', Auth::id())
                  ->where('status', 'Registered')
                  ->whereDoesntHave('payment');
            })
            ->with('event')
            ->orderByDesc('created_at')
            ->get();

        $pastTickets = Registration::with(['event', 'attendance'])
            ->where('user_id', Auth::id())
            ->whereHas('event', fn($q) => $q->where('event_date', '<', now()))
            ->orderByDesc('created_at')
            ->get();

        return view('tickets.index', compact('activeTickets', 'pastTickets'));
    }

    public function download($id)
    {
        $registration = Registration::with(['event', 'user'])
            ->where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Untuk sekarang redirect ke halaman tiket
        // Implementasi PDF bisa ditambah dengan package DomPDF
        return redirect()->route('tickets.index')
            ->with('info', 'Fitur download PDF akan segera tersedia.');
    }
}