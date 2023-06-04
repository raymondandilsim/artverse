<?php

namespace App\Http\Controllers;

use App\Models\Lukisan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanUtamaController extends Controller
{
    public function HomePage()
    {
        $lukisans = Lukisan::inRandomOrder()->limit(4)->get();
        $users = User::where('flag', '=', 1)->inRandomOrder()->limit(4)->get();
        
        return view('halaman-utama', ['lukisans' => $lukisans], ['users' =>$users]);
    }
}
