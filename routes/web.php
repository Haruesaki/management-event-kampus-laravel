<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('panitia.attendees');
});

Route::prefix('panitia')->group(function(){

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