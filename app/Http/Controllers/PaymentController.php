<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
   
    public function showPaymentPage()
    {
        if (Auth::check()) {
            return view('pago');
        } else {
            return redirect()->route('login');
        }
    }
   
}