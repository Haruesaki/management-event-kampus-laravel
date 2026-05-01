<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserManagementController;
// Jika kamu nanti membuat EventController, pastikan untuk di-import di sini
// use App\Http\Controllers\EventController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Di sinilah kamu mendaftarkan rute web untuk aplikasimu.
|
*/

// ==========================================
// RUTE PUBLIK (Bisa diakses tanpa login)
// ==========================================
Route::get('/', function () {
    return view('welcome'); // Mengarah ke resources/views/welcome.blade.php
})->name('home');


// ==========================================
// RUTE PANITIA & PESERTA (User Biasa)
// ==========================================
// Asumsi: Semua user yang login bisa masuk ke sini, atau kamu bisa tambah middleware role khusus
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Panitia/Peserta
    Route::get('/dashboard', function () {
        return view('dashboard'); 
    })->name('dashboard');

    // Manajemen Event (Tampilan publik/panitia)
    Route::get('/events', function () {
        return view('events.index');
    })->name('events.index');

    Route::get('/events/{id}', function ($id) {
        return view('events.show', compact('id'));
    })->name('events.show');

    // Manajemen Tiket (Peserta)
    Route::get('/tickets', function () {
        return view('tickets.index');
    })->name('tickets.index');
});


// ==========================================
// RUTE KHUSUS ADMIN
// ==========================================
// Prefix 'admin' membuat URL menjadi /admin/...
// Name 'admin.' membuat pemanggilan route menjadi route('admin.dashboard')
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // URL: /admin/dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Mengarah ke folder khusus admin yang kita bahas sebelumnya
    })->name('dashboard');

    // URL: /admin/users (Identity Matrix)
    // Menggunakan UserManagementController yang ada di app/Http/Controllers/
    Route::get('/users', [UserManagementController::class, 'index'])->name('users.index');
    
    // URL: /admin/users/bulk (Bulk Operations)
    Route::get('/users/bulk', [UserManagementController::class, 'bulkView'])->name('users.bulk');

    // URL: /admin/events (Curated Events)
    Route::get('/events', function () {
        return view('admin.events.index');
    })->name('events.index');

});


// ==========================================
// RUTE AUTENTIKASI (Login/Register)
// ==========================================
// Karena di views ada folder auth/ (login.blade.php, register.blade.php), 
// rute login & register diatur di sini (jika tidak menggunakan file auth.php terpisah bawaan Breeze)

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');
    
    // Kamu perlu menambahkan Route::post() untuk memproses form login & register ke Controller Auth-mu
});