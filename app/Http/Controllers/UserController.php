<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profilPage()
    {
        $user = Auth::user(); // get the currently authenticated user
        if(Auth::check() && Auth::user()->role_id === 2){
            return view('profil.profil-member', ['user' => $user]);
        }
        elseif(Auth::check() && Auth::user()->role_id === 3){
            return view('profil.profil-seniman', ['user' => $user]);
        }
    }

    public function ubahPeran(){
        
    }
}
