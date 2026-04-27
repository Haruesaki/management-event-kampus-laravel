<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Dashboard
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Alias "dashboard" → home (digunakan di layout navbar)
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->name('dashboard');

// User Management
Route::get('/user-management', [UserManagementController::class, 'index'])->name('user-management');

// Events
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

// Registrations (stub — will be implemented later)
Route::post('/registrations', function () {
    return back()->with('success', 'Booking berhasil! Fitur pembayaran akan segera hadir.');
})->name('registrations.store');

// Tickets stub
Route::get('/tickets', function () {
    return view('tickets.index');
})->name('tickets.index');

// Profile stub
Route::get('/profile', function () {
    return view('dashboard'); // placeholder
})->name('profile.show');

// Auth stubs (login/logout placeholder)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

