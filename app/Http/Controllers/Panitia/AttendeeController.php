<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;

class AttendeeController extends Controller
{
    public function index()
    {
        return view('panitia.attendees');
    }
}