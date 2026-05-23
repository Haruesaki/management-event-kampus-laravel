<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ─── ROOT: Tampilan Landing Page untuk Guest, atau Redirect jika Login ──────
Route::get('/', function (Illuminate\Http\Request $request) {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role_id === 1) return redirect()->route('admin.dashboard');
        if ($user->role_id === 2) return redirect()->route('panitia.dashboard');
        return redirect()->route('user.dashboard');
    }

    // Dummy events for landing page filtering
    $upcomingEvents = [
        [
            'id' => 3,
            'name' => 'Campus Marathon 2026',
            'category' => 'Sports',
            'venue' => 'Sports Complex',
            'date' => '2026-05-10',
            'time' => '06:00 AM',
            'price' => 5.00,
        ],
        [
            'id' => 4,
            'name' => 'Leadership Seminar',
            'category' => 'Seminar',
            'venue' => 'Auditorium A',
            'date' => '2026-06-20',
            'time' => '10:00 AM',
            'price' => 0,
        ],
    ];

    $filteredEvents = collect($upcomingEvents);

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

    return view('welcome', ['upcomingEvents' => $filteredEvents->values()->all()]);
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

    Route::get('/manage-event', function () {
        return view('panitia.events.manage');
    })->name('panitia.manage_event');

    Route::get('/create', function () {
        return view('panitia.create');
    })->name('panitia.event.create');

    Route::get('/events', function () {
        return view('panitia.events.index');
    })->name('panitia.events');

    Route::get('/archived-events', function () {
        return view('panitia.events.archived');
    })->name('panitia.archived_events');

});

// ─── PUBLIC USER / PESERTA ROUTES (Bisa diakses sebelum login) ──────────────
Route::prefix('user')->group(function () {

    // Dashboard user
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('user.dashboard');

    // Schedule page
    Route::get('/schedule', function () {
        $ongoingEvents = [
            [
                'id' => 1,
                'name' => 'Future Tech Summit',
                'category' => 'Technology',
                'time' => '09:00 - 17:00',
                'status' => 'Ongoing',
                'color' => '#b366ff'
            ],
            [
                'id' => 2,
                'name' => 'Digital Art Workshop',
                'category' => 'Art',
                'time' => '13:00 - 15:30',
                'status' => 'Ongoing',
                'color' => '#e055f5'
            ]
        ];

        $upcomingEvents = [
            [
                'id' => 3,
                'name' => 'Campus Marathon',
                'date' => 'May 10, 2026',
                'time' => '06:00 AM',
                'venue' => 'Sports Complex',
                'status' => 'Upcoming'
            ],
            [
                'id' => 4,
                'name' => 'Leadership Seminar',
                'date' => 'June 20, 2026',
                'time' => '10:00 AM',
                'venue' => 'Auditorium A',
                'status' => 'Upcoming'
            ]
        ];

        return view('user.schedule.index', compact('ongoingEvents', 'upcomingEvents'));
    })->name('schedule.index');

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
            'name' => 'Digital Art Workshop',
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