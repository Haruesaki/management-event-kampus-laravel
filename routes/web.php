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

// Dashboard alias — renders dashboard view directly (agar routeIs('dashboard') bekerja)
Route::get('/dashboard', function () {
    return view('dashboard');
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

// Tickets download stub
Route::get('/tickets/{id}/download', function ($id) {
    return back()->with('success', 'Download fitur akan segera hadir.');
})->name('tickets.download');

// Profile stub
Route::get('/profile', function () {
    return view('profile.show');
})->name('profile.show');

// Auth stubs (login/logout placeholder)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/login', function () {
    return back()->with('error', 'Fitur login akan segera hadir.');
})->name('login.post');

Route::post('/register', function () {
    return back()->with('error', 'Fitur register akan segera hadir.');
})->name('register.post');

