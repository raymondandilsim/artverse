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
            'username' => 'required',
            'password' => 'required|min:5|max:20',
        ],
        [
            'username.required' => 'Kolom Nama Pengguna harus terisi',
            'password.required' => 'Kolom kata sandi harus terisi',
            'password.min' => 'Kata sandi harus terdapat minimal 5 karakter',
            'password.max' => 'Kata sandi harus terdapat maksimal 20 karakter',
        ]);

        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials,false)){
            $user = Auth::user();
            $request->session()->regenerate();
            $request->session()->put('session', $credentials);

            if($user->flag == 2){
                Auth::logout();
                return redirect()->route('loginPage')->with('error', 'Akun ini sudah diblokir dari sistem');
            }
            elseif ($user->role_id == 3) {
                return redirect('/daftarLukisanPage');
            } else {
                return redirect('/');
            }
            
        }
        
        return back()->withErrors([
            'password' => 'Nama pengguna atau kata sandi salah',
        ]);
    }
    
    public function Logout(){
        if(Auth::check()){
            Auth::logout();
        }
        return redirect('/loginPage');
    }
}
