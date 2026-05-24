<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ─── ROOT: Langsung ke Dashboard sesuai Role ──────────────────────────────────
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role_id === 1) return redirect()->route('admin.dashboard');
        if ($user->role_id === 2) return redirect()->route('panitia.dashboard');
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('user.dashboard');
});

// ─── AUTH ROUTES (login, logout, register, dll.) ────────────────────────────
require __DIR__.'/auth.php';

// ─── ADMIN ROUTES ────────────────────────────────────────────────────────────
Route::prefix('admin')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/events', function () {
        return view('admin.events.index');
    })->name('admin.events');

    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('admin.users');

    Route::get('/users/bulk', function () {
        return view('admin.users.bulk');
    })->name('admin.users.bulk');

});

// ─── PANITIA ROUTES ───────────────────────────────────────────────────────────
Route::prefix('panitia')->middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        $user = Auth::user();
        $totalEvents = \App\Models\Event::where('created_by', $user->id)->count();
        $totalQuota = \App\Models\EventTicket::whereHas('event', function($q) use ($user) {
            $q->where('created_by', $user->id);
        })->sum('quota');
        
        $latestEvents = \App\Models\Event::with('tickets')
            ->where('created_by', $user->id)
            ->latest()
            ->take(3)
            ->get();

        return view('panitia.dashboard', compact('totalEvents', 'totalQuota', 'latestEvents'));
    })->name('panitia.dashboard');

    Route::get('/manage-event', [\App\Http\Controllers\Panitia\EventController::class, 'manage'])->name('panitia.manage_event');

    Route::get('/create', [\App\Http\Controllers\Panitia\EventController::class, 'create'])->name('panitia.event.create');
    Route::post('/create', [\App\Http\Controllers\Panitia\EventController::class, 'store'])->name('panitia.event.store');

    Route::get('/events', [\App\Http\Controllers\Panitia\EventController::class, 'index'])->name('panitia.events');
    Route::get('/events/{id}/edit', [\App\Http\Controllers\Panitia\EventController::class, 'edit'])->name('panitia.event.edit');
    Route::post('/events/{id}/update', [\App\Http\Controllers\Panitia\EventController::class, 'update'])->name('panitia.event.update');
    Route::post('/events/{id}/close', [\App\Http\Controllers\Panitia\EventController::class, 'close'])->name('panitia.event.close');

    Route::get('/archived-events', function () {
        return view('panitia.events.archived');
    })->name('panitia.archived_events');

});

// ─── PUBLIC USER / PESERTA ROUTES (Bisa diakses sebelum login) ──────────────
Route::prefix('user')->group(function () {

    // Dashboard user
    Route::get('/dashboard', function () {
        $today = \Carbon\Carbon::today();
        
        // 1. Ambil Event Aktif (is_closed 0 DAN tanggal <= 14 hari ke depan atau sudah lewat tapi belum ditutup)
        $activeEvents = \App\Models\Event::with('tickets')
            ->where('is_closed', 0)
            ->whereDate('event_date', '<=', $today->copy()->addDays(14))
            ->latest()
            ->get();

        // 2. Ambil Event Mendatang (> 14 hari)
        $upcomingEvents = \App\Models\Event::with('tickets')
            ->where('is_closed', 0)
            ->whereDate('event_date', '>', $today->copy()->addDays(14))
            ->latest()
            ->get();

        return view('dashboard', compact('activeEvents', 'upcomingEvents'));
    })->name('user.dashboard');

    // Schedule page
    Route::get('/schedule', function () {
        $ongoingEvents = []; // Bisa diisi query DB nanti
        $upcomingEvents = \App\Models\Event::latest()->take(2)->get();
        return view('user.schedule.index', compact('ongoingEvents', 'upcomingEvents'));
    })->name('schedule.index');

    // Alias: events.index → Discovery Page dengan Data Asli
    Route::get('/events', function (Illuminate\Http\Request $request) {
        $query = \App\Models\Event::with('tickets');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%")
                  ->orWhere('location', 'like', "%$search%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // Filter harga (berdasarkan tiket termurah)
        if ($request->filled('price')) {
            if ($request->price === 'free') {
                $query->whereHas('tickets', function($q) {
                    $q->where('type', 'Gratis');
                });
            } elseif ($request->price === 'paid') {
                $query->whereHas('tickets', function($q) {
                    $q->where('type', 'Berbayar');
                });
            }
        }

        $events = $query->latest()->get();
        return view('user.events.index', compact('events'));
    })->name('events.index');

    // Detail event
    Route::get('/events/{id}', function ($id) {
        $event = \App\Models\Event::with('tickets')->findOrFail($id);
        return view('user.events.show', compact('event'));
    })->name('events.show');

});

// ─── PROTECTED USER / PESERTA ROUTES (Harus login) ───────────────────────────
Route::prefix('user')->middleware(['auth'])->group(function () {

    // Booking Ticket
    Route::post('/booking', [\App\Http\Controllers\BookingController::class, 'store'])->name('events.booking');

    // My Tickets
    Route::get('/tickets', [\App\Http\Controllers\BookingController::class, 'index'])->name('tickets.index');

    // Profile (placeholder)
    Route::get('/profile', function () {
        return view('user.profile.show');
    })->name('profile.show');

});

// ─── LEGACY / DASHBOARD UMUM (fallback untuk route('dashboard')) ─────────────
Route::get('/dashboard', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role_id === 1) return redirect()->route('admin.dashboard');
        if ($user->role_id === 2) return redirect()->route('panitia.dashboard');
        return redirect()->route('user.dashboard');
    }
    return redirect()->route('user.dashboard');
})->middleware([])->name('dashboard');