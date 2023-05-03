<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function LoginPage()
    {
        return view('login');
    }

    public function Login(Request $request){
        $request->validate([
            'nama' => 'required|regex:/^[a-zA-Z]+$/',
            'password' => 'required|min:5|max:20',
        ]);

        $credentials = [
            'nama' => $request->nama,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials,false)){
            $request->session()->regenerate();
            $request->session()->put('session', $credentials);
            return redirect('/');
        }

        return back()->withErrors([
            'password' => 'Nama atau kata sandi salah',
        ]);
    }

    public function Logout(){
        if(Auth::check()){
           Auth::logout();
        }
        return redirect('/loginPage');
    }
}
