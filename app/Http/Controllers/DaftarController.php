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
            'nama' => 'required|regex:/^[a-zA-Z]+$/',
            'username' => 'required|unique:users,username|regex:/^[a-zA-Z\0-9]+$/',
            'email' => 'required|email|unique:users,email',
            'nomor_telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
            'nama_provinsi' => 'required',
            'nama_kota' => 'required',
            'password' => 'required|min:5|max:20',
            'confirm_password' => 'required|same:password|min:5|max:20'
        ],
        [
            'nama.required' => 'Kolom nama harus terisi',
            'nama.regex' => 'Nama harus terdapat huruf kecil atau huruf besar',
            'username.required' => 'Kolom username harus terisi',
            'username.unique' => 'Username sudah digunakan',
            'username.regex' => 'Username harus terdapat huruf atau angka',
            'email.required' => 'Kolom email harus terisi',
            'email.email' => 'Email yang dimasukkan harus sesuai',
            'email.unique' => 'Email sudah digunakan',
            'nomor_telepon.required' => 'Kolom telepon harus terisi',
            'nomor_telepon.regex' => 'Telepon harus terisi angka',
            'nomor_telepon.min' => 'Telepon harus terdapat 10 digit',
            'nomor_telepon.max' => 'Telepon harus terdapat 13 digit',
            'nama_provinsi.required' => 'Kolom provinsi harus terisi',
            'nama_kota.required' => 'Kolom kota harus terisi',
            'password.required' => 'Kolom kata sandi harus terisi',
            'password.min' => 'Kata sandi harus terdapat minimal 5 karakter',
            'password.max' => 'Kata sandi harus terdapat maksimal 20 karakter',
            'confirm_password.required' => 'Kolom kata sandi harus terisi',
            'confirm_password.same' => 'Kolom kata sandi harus sama',
            'confirm_password.min' => 'Kata sandi harus terdapat minimal 5 karakter',
            'confirm_password.max' => 'Kata sandi harus terdapat maksimal 20 karakter',
        ]);

        $user = new User();
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->nama_provinsi = $request->nama_provinsi;
        $user->nama_kota = $request->nama_kota;
        $user->password = Hash::make($request->password);
        $user->role_id = 2;
        $user->save();

         return redirect('/loginPage');
    }
}

