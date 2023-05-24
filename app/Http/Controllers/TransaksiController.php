<?php

namespace App\Http\Controllers;

use App\Models\Lukisan;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function checkoutPage($id){
        $lukisan = Lukisan::findOrFail($id);
        return view('transaksi.checkout', compact('lukisan'));
    }
}
