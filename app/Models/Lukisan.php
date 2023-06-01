<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lukisan extends Model
{
    use HasFactory;

    protected $table = 'lukisans';

    public function unggahLukisan($user_id, $namaLukisan, $hargaLukisan, $deskripsi, $stokLukisan, $kondisiLukisan,
                                    $beratLukisan, $ukuranLukisan, $gambarLukisan1, $gambarLukisan2, $gambarLukisan3){
        $lukisan = new Lukisan();
        $lukisan->user_id = $user_id;
        $lukisan->nama_lukisan = $namaLukisan;
        $lukisan->harga = $hargaLukisan;
        $lukisan->deskripsi = $deskripsi;
        $lukisan->stok = $stokLukisan;
        $lukisan->kondisi = $kondisiLukisan;
        $lukisan->berat = $beratLukisan;
        $lukisan->ukuran = $ukuranLukisan;
        $lukisan->gambar_pertama = $gambarLukisan1;
        $lukisan->gambar_kedua = $gambarLukisan2;
        $lukisan->gambar_ketiga = $gambarLukisan3;
        $lukisan->save();
    }

    public function perbaruiLukisan($id, $namaLukisanBaru, $hargaLukisanBaru, $deskripsiBaru, $stokLukisanBaru, $kondisiLukisanBaru,
                                    $beratLukisanBaru, $ukuranLukisanBaru, $gambarLukisan1Baru, $gambarLukisan2Baru, $gambarLukisan3Baru){
        $lukisan = Lukisan::findOrFail($id);
        $lukisan->nama_lukisan = $namaLukisanBaru;
        $lukisan->harga = $hargaLukisanBaru;
        $lukisan->deskripsi = $deskripsiBaru;
        $lukisan->stok = $stokLukisanBaru;
        $lukisan->kondisi = $kondisiLukisanBaru;
        $lukisan->berat = $beratLukisanBaru;
        $lukisan->ukuran = $ukuranLukisanBaru;
        $lukisan->gambar_pertama = $gambarLukisan1Baru;
        $lukisan->gambar_kedua = $gambarLukisan2Baru;
        $lukisan->gambar_ketiga = $gambarLukisan3Baru;
        $lukisan->save();
    }

    public function hapusLukisanById($id)
    {
        $this->where('id', '=', $id)->delete();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function detailTransaksis()
    // {
    //     return $this->hasMany(DetailTransaksi::class);
    // }
}
