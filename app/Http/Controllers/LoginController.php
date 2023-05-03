<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function LoginPage()
    {
        return view('login');
    }

    public function Login(Request $request){
        $credentials = $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z]+$/',
            'katasandi' => 'required|min:5|max:20',
        ]);

        if(Auth::attempt($credentials,false)){
            $request->session()->regenerate();
            $request->session()->put('session', $credentials);
            return redirect('/');
        }

        return back()->withErrors([
            'katasandi' => 'Nama atau kata sandi salah',
        ]);
    }

    public function Logout(){
        if(Auth::check()){
           Auth::logout();
        }
        return redirect('/loginPage');
    }
}
