<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserManagementController;
Route::get('/user-management', [UserManagementController::class, 'index']);

Route::get('/', function () {
    return view('dashboard');
});


