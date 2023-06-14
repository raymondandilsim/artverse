<?php

namespace App\Http\Controllers;

use App\Models\Lukisan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HalamanController extends Controller
{
    public function HomePage()
    {
        $lukisans = Lukisan::join('users', 'users.id', '=', 'lukisans.user_id')
        ->where('users.flag', 1)
        ->where('lukisans.flag', 0)
        ->inRandomOrder()
        ->limit(4)
        ->select('lukisans.*')
        ->get();
        $users = User::where('flag', '=', 1)->inRandomOrder()->limit(4)->get();
        
        return view('halaman-utama', ['lukisans' => $lukisans], ['users' =>$users]);
    }

    public function KontakPage()
    {
        return view('kontak');
    }

    public function TentangPage()
    {
        return view('tentang');
    }

    public function SyaratketentuanPage()
    {
        return view('syaratketentuan');
    }
}
