<?php

namespace App\Http\Controllers;

use App\Models\Lukisan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LukisanController extends Controller
{
    public function unggahLukisanPage()
    {
        return view('lukisan.unggah-lukisan');
    }

    public function unggahLukisan(Request $request){
        $request->validate([
            'namaLukisan' =>'required|string',
            'hargaLukisan' => 'required|numeric|min:0',
            'deskripsiLukisan' =>'required|string|max:2000',
            'stokLukisan' => 'required|numeric|min:1',
            'gambarLukisan'=>'required|mimes:jpg,jpeg,png',
        ],
        [
            'namaLukisan.required' => 'Kolom Nama Lukisan harus terisi',
            'hargaLukisan.required' => 'Kolom Harga lukisan harus terisi',
            'hargaLukisan.numeric' => 'Kolom Harga lukisan harus dalam bentuk angka',
            'hargaLukisan.min' => 'Kolom Harga lukisan harus diisi dengan harga yang valid',
            'deskripsiLukisan.required' => 'Kolom Deskripsi lukisan harus terisi',
            'deskripsiLukisan.max' => 'Kolom Deskripsi lukisan maksimal 2000 karakter',
            'stokLukisan.required' => 'Kolom Stok lukisan harus terisi',
            'stokLukisan.numeric' => 'Kolom Stok lukisan harus dalam bentuk angka',
            'stokLukisan.min' => 'Stok lukisan harus minimal 1 unit',
            'gambarLukisan.required' => 'Kolom Gambar lukisan harus terisi',
            'gambarLukisan.mimes' => 'File Gambar harus dalam bentuk .jpeg/.jpg/.png',

        ]);
        
        $lukisan = new Lukisan();
        $user_id = Auth::user()->id;
        $nama_lukisan = $request->namaLukisan;
        $harga = $request->hargaLukisan;
        $deskripsi = $request->deskripsiLukisan;
        $stok = $request->stokLukisan;
        $gambarLukisan = $request->file('gambarLukisan');
        $gambarLukisan->store('/public/gambar-lukisan');
        $gambarLukisan = asset('storage/gambar-lukisan/'.$gambarLukisan->hashName());
        $gambar = $gambarLukisan;

        $lukisan->unggahLukisan($user_id, $nama_lukisan, $harga, $deskripsi, $stok, $gambar);

        return redirect('/unggahLukisanPage')->with('status', "Lukisan Berhasil Ditambahkan");
    }
}
