<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanUtamaController extends Controller
{
    public function HomePage()
    {
        $user = Auth::user();
        return view('halaman-utama', ['user' => $user]);
    }
}
