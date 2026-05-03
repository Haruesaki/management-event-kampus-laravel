<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Panitia\DashboardController;
use App\Http\Controllers\Panitia\AttendeeController;
use App\Http\Controllers\Panitia\EventController;
use App\Http\Controllers\Panitia\PaymentController;
use App\Http\Controllers\EventController as UserEventController;

// ── Root ──────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
});

// ── Auth ──────────────────────────────────────────────
Route::get('/login', [LoginController::class, 'showForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ── Admin ─────────────────────────────────────────────
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('Admin.dashboard');         // ✅ Admin/dashboard.blade.php
    })->name('admin.dashboard');

    Route::get('/events', function () {
        return view('Admin.events.index');      // ✅ Admin/events/index.blade.php
    })->name('admin.events');

    Route::get('/users', function () {
        return view('Admin.users.index');       // ✅ Admin/users/index.blade.php
    })->name('admin.users');

    Route::get('/bulk-operations', function () {
        return view('Admin.users.bulk');        // ✅ Admin/users/bulk.blade.php
    })->name('admin.bulk');
});

// ── Panitia ───────────────────────────────────────────
Route::prefix('panitia')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('panitia.dashboard');
    Route::get('/attendees', [AttendeeController::class, 'index'])->name('panitia.attendees');
    Route::get('/events', [EventController::class, 'index'])->name('panitia.events');
    Route::get('/events/create', [EventController::class, 'create'])->name('panitia.event.create');
    Route::get('/payments', [PaymentController::class, 'index'])->name('panitia.payments');
});

// ── User ──────────────────────────────────────────────
Route::get('/events', [UserEventController::class, 'index'])->name('user.events');
Route::get('/events/{id}', [UserEventController::class, 'show'])->name('events.show');
Route::post('/register', [App\Http\Controllers\RegistrationController::class, 'store'])->name('registration.store');
Route::get('/payment/{registration}', [App\Http\Controllers\RegistrationController::class, 'payment'])->name('payment.show');
Route::post('/payment/{registration}/process', [App\Http\Controllers\RegistrationController::class, 'process'])->name('payment.process');
Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets', [App\Http\Controllers\TicketController::class, 'index'])->name('tickets.index');
Route::get('/tickets/download/{id}', [App\Http\Controllers\TicketController::class, 'download'])->name('tickets.download');

Route::get('/dashboard', function() {
    return view('dashboard');
})->name('user.dashboard');

Route::get('/profile', function() {
    return view('Profile.show');
})->name('user.profile');
Route::get('/bulk-operations', function () {
        return view('Admin.users.bulk');
    })->name('admin.bulk');