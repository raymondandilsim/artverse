<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function checkoutPage(){
        return view('transaksi.checkout');
    }
}
