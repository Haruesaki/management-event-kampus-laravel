<?php

namespace App\Http\Controllers\Panitia;

use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index()
    {
        return view('panitia.payments');
    }
}