<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lukisan extends Model
{
    use HasFactory;

    public function unggahLukisan($user_id, $namaLukisan, $hargaLukisan, $deskripsi, $stokLukisan, $gambarLukisan){
        $lukisan = new Lukisan();
        $lukisan->user_id = $user_id;
        $lukisan->nama_lukisan = $namaLukisan;
        $lukisan->harga = $hargaLukisan;
        $lukisan->deskripsi = $deskripsi;
        $lukisan->stok = $stokLukisan;
        $lukisan->gambar = $gambarLukisan;
        $lukisan->save();
    }

    public function updateLukisan(){
        
    }
}
