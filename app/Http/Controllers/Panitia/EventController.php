<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;

class EventController extends Controller
{
    public function index()
    {
        return view('panitia.events.index');
    }

    public function create()
    {
        return view('panitia.create');
    }
}