<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function KontakPage()
    {
        return view('kontak');
    }
}
