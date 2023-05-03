<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DaftarController extends Controller
{
    public function DaftarPage()
    {
        return view('daftar');
    }
    public function Daftar(Request $request){
        $request->validate([
            'nama' => 'required|unique:users,nama|regex:/^[a-zA-Z]+$/',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:20',
        ],
        [
            'nama.required' => 'Kolom nama harus terisi',
            'nama.unique' => 'Nama sudah digunakkan',
            'nama.regex' => 'Nama harus terdapat huruf kecil dan huruf besar',
            'email.required' => 'Kolom email harus terisi',
            'email.email' => 'Email yang dimasukkan harus sesuai',
            'email.unique' => 'Email sudah digunakkan',
            'password.required' => 'Kolom kata sandi harus terisi',
            'password.min' => 'Kata sandi harus terdapat minimal 5 karakter',
            'password.max' => 'Kata sandi harus terdapat maksimal 20 karakter',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = "Member";
        $user->save();

         return redirect('/loginPage');
    }
}

