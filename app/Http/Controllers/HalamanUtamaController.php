<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HalamanUtamaController extends Controller
{
    public function HomePage()
    {
        return view('halaman-utama');
    }
}
