<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DaftarController extends Controller
{
    public function DaftarPage()
    {
        $provinsis = Provinsi::all();

        return view('daftar', compact('provinsis'));
    }

    public function getKotaByProvinsi($provinsiId)
    {
        $kotas = Kota::where('provinsi_id', '=', $provinsiId)->pluck('nama_kota', 'id');

        return json_encode($kotas);
    }

    public function Daftar(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required|regex:/^[a-zA-Z ]+$/',
                'username' => 'required|unique:users,username|regex:/^[a-zA-Z\0-9]+$/',
                'email' => 'required|email|unique:users,email',
                'nomor_telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
                'provinsi' => 'required',
                'kota' => 'required',
                'nama_jalan' => 'required',
                'kode_pos' => 'required|min:5',
                'password' => 'required|min:5|max:20',
                'confirm_password' => 'required|same:password|min:5|max:20'
            ],
            [
                'nama.required' => 'Kolom Nama harus terisi',
                'nama.regex' => 'Nama harus terdapat huruf kecil atau huruf besar',
                'username.required' => 'Kolom Nama Pengguna harus terisi',
                'username.unique' => 'Nama Pengguna sudah digunakan',
                'username.regex' => 'Nama Pengguna harus terdapat huruf atau angka',
                'email.required' => 'Kolom Email harus terisi',
                'email.email' => 'Email yang dimasukkan harus sesuai',
                'email.unique' => 'Email sudah digunakan',
                'nomor_telepon.required' => 'Kolom Telepon harus terisi',
                'nomor_telepon.regex' => 'Telepon harus terisi angka',
                'nomor_telepon.min' => 'Telepon harus terdapat 10 digit',
                'nomor_telepon.max' => 'Telepon harus terdapat 13 digit',
                'provinsi.required' => 'Kolom Provinsi harus terisi',
                'kota.required' => 'Kolom Kota harus terisi',
                'nama_jalan.required' => 'Kolom Nama Jalan harus terisi',
                'kode_pos.required' => 'Kolom Kode Pos harus terisi',
                'kode_pos.min' => 'Kode Pos wajib 5 digit angka',
                'password.required' => 'Kolom Kata Sandi harus terisi',
                'password.min' => 'Kata Sandi harus terdapat minimal 5 karakter',
                'password.max' => 'Kata Sandi harus terdapat maksimal 20 karakter',
                'confirm_password.required' => 'Kolom Kata Sandi harus terisi',
                'confirm_password.same' => 'Kolom Sandi Ulang harus sama dengan Kata Sandi',
                'confirm_password.min' => 'Kata Sandi harus terdapat minimal 5 karakter',
                'confirm_password.max' => 'Kata Sandi harus terdapat maksimal 20 karakter',
            ]
        );

        // $provinsi_id = Provinsi::findOrFail($request->provinsi);
        // $nama_provinsi = $provinsi_id->provinsi;

        // $kota_id = Kota::findOrFail($request->kota);
        // $nama_kota = $kota_id->nama_kota;


        $user = new User();
        $user->role_id = 2;
        $user->nama = $request->nama;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->nomor_telepon = $request->nomor_telepon;
        $user->provinsi_id = $request->provinsi;
        $user->kota_id = $request->kota;
        $user->nama_jalan = $request->nama_jalan;
        $user->kode_pos = $request->kode_pos;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/loginPage')->with('status', "Akun Berhasil Dibuat");
    }
}
