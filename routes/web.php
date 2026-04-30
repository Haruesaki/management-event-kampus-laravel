<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserManagementController;
Route::get('/user-management', [UserManagementController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
});

use App\Http\Controllers\Panitia\DashboardController;
use App\Http\Controllers\Panitia\EventController;
use App\Http\Controllers\Panitia\AttendeeController;
use App\Http\Controllers\Panitia\PaymentController;

Route::prefix('panitia')->middleware(['auth','role:panitia'])->group(function(){

    Route::get('/dashboard', [DashboardController::class,'index'])->name('panitia.dashboard');

    Route::get('/event/create', [EventController::class,'create'])->name('panitia.event.create');
    Route::post('/event/store', [EventController::class,'store']);

    Route::get('/attendee', [AttendeeController::class,'index'])->name('panitia.attendee');

    Route::get('/payment', [PaymentController::class,'index'])->name('panitia.payment');
});



