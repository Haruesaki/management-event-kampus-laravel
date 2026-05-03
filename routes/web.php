<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ─── ROOT: redirect ke login jika belum login, atau ke dashboard role ──────
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
        return view('panitia.dashboard');
    })->name('panitia.dashboard');

    Route::get('/attendees', function () {
        return view('panitia.attendees');
    })->name('panitia.attendees');

    Route::get('/create', function () {
        return view('panitia.create');
    })->name('panitia.event.create');

    Route::get('/events', function () {
        return view('panitia.events.index');
    })->name('panitia.events');

});

// ─── PUBLIC USER / PESERTA ROUTES (Bisa diakses sebelum login) ──────────────
Route::prefix('user')->group(function () {

    // Dashboard user
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');

    $dummyEvents = [
        [
            'id' => 1,
            'name' => 'Future Tech Summit',
            'category' => 'Technology',
            'venue' => 'Main Engineering Hall',
            'price' => 25.00,
            'date' => '2026-03-15',
            'color' => 'linear-gradient(135deg, #1e1a30, #2a2040)',
        ],
        [
            'id' => 2,
            'name' => 'Canvas of Dreams',
            'category' => 'Art',
            'venue' => 'Fine Arts Pavilion',
            'price' => 0,
            'date' => '2026-04-02',
            'color' => 'linear-gradient(135deg, #1e2a1a, #2a3520)',
        ],
        [
            'id' => 3,
            'name' => 'Campus Marathon',
            'category' => 'Sports',
            'venue' => 'Sports Complex',
            'price' => 5.00,
            'date' => '2026-05-10',
            'color' => 'linear-gradient(135deg, #2a1e1a, #402020)',
        ],
        [
            'id' => 4,
            'name' => 'Leadership Seminar',
            'category' => 'Seminar',
            'venue' => 'Auditorium A',
            'price' => 0,
            'date' => '2026-06-20',
            'color' => 'linear-gradient(135deg, #1a2a2e, #203a40)',
        ],
    ];

    // Alias: events.index → view yang sama (untuk filter form di user view)
    Route::get('/events', function (Illuminate\Http\Request $request) use ($dummyEvents) {
        $filteredEvents = collect($dummyEvents);

        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $filteredEvents = $filteredEvents->filter(function($event) use ($search) {
                return str_contains(strtolower($event['name']), $search) || 
                       str_contains(strtolower($event['venue']), $search);
            });
        }

        if ($request->filled('category')) {
            $filteredEvents = $filteredEvents->filter(function($event) use ($request) {
                return strtolower($event['category']) === strtolower($request->category);
            });
        }

        if ($request->filled('price')) {
            if ($request->price === 'free') {
                $filteredEvents = $filteredEvents->filter(function($event) {
                    return $event['price'] == 0;
                });
            } elseif ($request->price === 'paid') {
                $filteredEvents = $filteredEvents->filter(function($event) {
                    return $event['price'] > 0;
                });
            }
        }

        return view('user.events.index', ['events' => $filteredEvents->values()->all()]);
    })->name('events.index');

    // Detail event (placeholder)
    Route::get('/events/{id}', function ($id) use ($dummyEvents) {
        $event = collect($dummyEvents)->firstWhere('id', (int) $id);
        if (!$event) {
            abort(404);
        }
        return view('user.events.show', compact('event'));
    })->name('events.show');

});

// ─── PROTECTED USER / PESERTA ROUTES (Harus login) ───────────────────────────
Route::prefix('user')->middleware(['auth'])->group(function () {

    // Tickets (placeholder)
    Route::get('/tickets', function () {
        return view('user.tickets.index');
    })->name('tickets.index');

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