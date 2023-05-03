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
            'katasandi' => 'required|min:5|max:20',
        ],
        [
            'nama.required' => 'Kolom nama harus terisi',
            'nama.unique' => 'Nama sudah digunakkan',
            'nama.regex' => 'Nama harus terdapat huruf kecil dan huruf besar',
            'email.required' => 'Kolom email harus terisi',
            'email.email' => 'Email yang dimasukkan harus sesuai',
            'email.unique' => 'Email sudah digunakkan',
            'katasandi.required' => 'Kolom kata sandi harus terisi',
            'katasandi.min' => 'Kata sandi harus terdapat minimal 5 karakter',
            'katasandi.max' => 'Kata sandi harus terdapat maksimal 20 karakter',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->email = $request->email;
        $user->katasandi = Hash::make($request->katasandi);
        $user->role = "Member";
        $user->save();

         return redirect('/loginPage');
    }
}

