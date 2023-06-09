<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\Provinsi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function profilPage()
    {
        $user = Auth::user(); // get the currently authenticated user
        if(Auth::check() && Auth::user()->role_id === 2){
            return view('profil.profil-member', ['user' => $user]);
        }
    }

    public function ubahPeran($userId){
        $user = User::find($userId);
        if($user->role_id === 2){
            $user->role_id = 3;
            $user->save();
            return redirect('/daftarLukisanPage')->with('status', "Status Anda Berubah Menjadi Seniman");
            // return redirect('/profilPage')->with('status', "Berhasil")->with('user', $user);
        }
        elseif($user->role_id === 3){
            $user->role_id = 2;
            $user->save();
            return redirect('/')->with('status', "Anda Kembali Menjadi Member");
        }
    }

    public function ubahProfilPage($id)
    {
        $user = User::findOrFail($id); // get the currently authenticated user
        $provinsis = Provinsi::all();

        return view('profil.ubah-profil', compact('provinsis', 'user'));
        
    }
    
    public function getKotaByProvinsi($provinsiId)
    {
        $kotas = Kota::where('provinsi_id', '=', $provinsiId)->pluck('nama_kota', 'id');

        return json_encode($kotas);
    }

    public function ubahProfil(Request $request, $id)
    {
        $request->validate(
            [
                'nama' => 'required|regex:/^[a-zA-Z ]+$/',
                'username' => 'required|regex:/^[a-zA-Z\0-9]+$/',
                'email' => 'required',
                'nomor_telepon' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:13',
                'provinsi' => 'required',
                'kota' => 'required',
                'nama_jalan' => 'required',
                'kode_pos' => 'required|min:5',
                'password' => 'required|min:5|max:20',
                'confirm_password' => 'required|same:password|min:5|max:20',
                'fotoProfil' => 'mimes:jpg,jpeg,png',
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
                'fotoProfil.mimes' => 'File Foto Profil harus dalam bentuk .jpeg/.jpg/.png',
            ]
        );

        $userLama = User::findOrFail($id);

        // $provinsi_id = Provinsi::findOrFail($request->provinsi);
        // $nama_provinsi = $provinsi_id->provinsi;

        // $kota_id = Kota::findOrFail($request->kota);
        // $nama_kota = $kota_id->nama_kota;

        $validator = Validator::make(
                [
                    'email' => $request->email,
                    'username' => $request->username
                ],
                [
                    'email' => 'unique:users,email,' . $id,
                    'username' => 'unique:users,username,' . $id
                ]
            );

        // insert data baru
        if ($validator->passes()) {
            $userLama->nama = $request->nama;
            $userLama->username = $request->username;
            $userLama->email = $request->email;
            $userLama->nomor_telepon = $request->nomor_telepon;
            $userLama->provinsi_id = $request->provinsi;
            $userLama->kota_id = $request->kota;
            $userLama->nama_jalan = $request->nama_jalan;
            $userLama->kode_pos = $request->kode_pos;
            $userLama->nama_bank = $request->nama_bank;
            $userLama->nomor_rekening = $request->nomor_rekening;
            $userLama->password = Hash::make($request->password);

            $fotoProfilBaru = $request->file('fotoProfil');
            if ($fotoProfilBaru == null) {
                $fotoProfilBaru = $userLama->foto_profil;
            } else {
                $this->deleteFotoProfilFromDB($userLama);
                $fotoProfilBaru->store('/public/foto-profil');
                $fotoProfilBaru = asset('storage/foto-profil/' . $fotoProfilBaru->hashName());
                $userLama->foto_profil = $fotoProfilBaru;
            }
            $userLama->save();
            return view('profil.profil-member', ['user' => $userLama])->with('status', "Profil Berhasil Diperbarui");
        } else {
            return back()->with('errors');
        }

    }

    // public function deleteFotoProfilFromDB($user)
    // {
    //     foreach (explode('/', $user->foto_profil) as $item) {
    //         if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
    //             File::delete(public_path("storage/foto-profil/" . $item));
    //         }
    //     }
    // }

    public function deleteFotoProfilFromDB($user)
    {
        $fotoProfil = $user->foto_profil;

        if ($fotoProfil) {
            // Get the filename from the photo URL
            $filename = basename($fotoProfil);

            // Delete the existing profile picture if it exists
            $path = public_path("storage/foto-profil/" . $filename);
            if (File::exists($path)) {
                File::delete($path);
            }
        }
    }

    public function showSeniman(){
        $users = User::where('flag', '=', 1)->Paginate(6);
        return view('lihat-semua-seniman',['users'=> $users]);
    }

    public function detailSeniman($id){
        $user = User::findOrFail($id);
        return view('detail-seniman', compact('user'));
    }

    public function lihatSemuaAkun(){

        $users = User::paginate(10);

        return view('daftar-semua-akun', compact('users'));
    }

    public function blokirAkun($id)
    {
        // User::find($id)->delete();
        $user = User::findOrFail($id);
        $user->flag = 2;
        $user->save();

        return back()->with('status', 'Akun telah diblokir dari sistem.');
    }

}
