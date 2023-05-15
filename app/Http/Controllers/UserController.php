<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Event\RequestEvent;

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

    public function ubahPeran($userId){
        $user = User::find($userId);
        if($user->role_id === 2){
            $user->role_id = 3;
            $user->save();
            return redirect('/profilPage')->with('status', "Berhasil");
        }
        elseif($user->role_id === 3){
            $user->role_id = 2;
            $user->save();
            return redirect('/profilPage')->with('status', "Berhasil");;
        }
    }
}
