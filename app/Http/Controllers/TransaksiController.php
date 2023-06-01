<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Kota;
use App\Models\Lukisan;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
    // public function checkoutPage($id){
    //     $lukisan = Lukisan::findOrFail($id);
    //     $quantity = request('quantity');

    //     return view('transaksi.checkout', compact('lukisan', 'quantity'));
    // }

    public function checkoutPage(Request $request, $lukisanId){
        $user = Auth::user();
        $lukisan = Lukisan::findOrFail($lukisanId);
        
        // Asal Kota Penjual (Origin)
        $kotaPenjual = $lukisan->user->nama_kota;

        // Ubah Nama Kota jadi ID Kota biar bisa dihitung dengan API
        $namaKotaOrigin = Kota::where('nama_kota', $kotaPenjual)->first();

        if ($namaKotaOrigin) {
            $idOrigin = $namaKotaOrigin->id;
        } else {
            $idOrigin = '';
        }

        // Asal Kota Pembeli (Destination)
        $kotaPembeli = $user->nama_kota;

        // Ubah Nama Kota jadi ID Kota biar bisa dihitung dengan API
        $namaKotaDestination = Kota::where('nama_kota', $kotaPembeli)->first();

        if ($namaKotaDestination) {
            $idDestination = $namaKotaDestination->id;
        } else {
            $idDestination = '';
        }

        $quantity = request('quantity');
        
        $origin = $idOrigin;
        $destination = $idDestination;
        $weight = $quantity * $lukisan->berat;
        // $courier = $request->courier;

        $response = Http::asForm()->withHeaders([
            'key' => 'a6af13d8694b086e5148df4cb5693e79'
        ])->post('https://api.rajaongkir.com/starter/cost',[
            'origin' => $origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => 'jne'
        ]);

        $cekOngkir = $response['rajaongkir']['results'][0]['costs'];

        $subtotalProduk = $quantity * $lukisan->harga;
        $asuransi = $quantity * (2/1000 * $lukisan->harga) + 5000;
        $hargaPengiriman = $request->jenisPengiriman;
        
        $totalPembayaran = $subtotalProduk + $hargaPengiriman + $asuransi;

        return view('transaksi.checkout', compact('lukisan', 'quantity', 'subtotalProduk', 'asuransi', 'hargaPengiriman', 'totalPembayaran', 'cekOngkir'));
    }

    public function pembayaranPage(Request $request, $lukisanId, $quantity)
    {   
        $transaksi = new Transaksi();
        $detailTransaksi = new DetailTransaksi();
        $user = Auth::user();
        $lukisan = Lukisan::findOrFail($lukisanId);

        $subtotalProduk = $quantity * $lukisan->harga;
        $subtotalAsuransi = $quantity * (2 / 1000 * $lukisan->harga) + 5000;
        $subtotalPengiriman = $request->jenisPengiriman;
        $totalPembayaran = $subtotalProduk + $subtotalPengiriman + $subtotalAsuransi;
        $catatan = $request->catatan;

        $alamatDestinasi = $user->nama_jalan . ',' . $user->nama_kota . ',' . $user->nama_provinsi . ',' . $user->kode_pos;

        $transaksi->user_id = $user->id;
        $transaksi->tanggal_pembelian = date('Y-m-d H:i:s');
        $transaksi->total_pembelian = $totalPembayaran;
        $transaksi->status = 'Belum Bayar';
        $transaksi->bukti_pembayaran = '';
        $transaksi->save();

        $detailTransaksi->transaksi_id = $transaksi->id;
        $detailTransaksi->lukisan_id = $lukisan->id;
        $detailTransaksi->kuantitas = $quantity;
        $detailTransaksi->subtotal_produk = $subtotalProduk;
        $detailTransaksi->subtotal_pengiriman = $subtotalPengiriman;
        $detailTransaksi->subtotal_asuransi = $subtotalAsuransi;
        $detailTransaksi->harga_total = $totalPembayaran;
        $detailTransaksi->alamat_asal = $lukisan->user->nama_kota;
        $detailTransaksi->alamat_destinasi = $alamatDestinasi;
        $detailTransaksi->bukti_pengiriman = '';
        $detailTransaksi->catatan = $catatan;
        $detailTransaksi->save();

        return view('transaksi.pembayaran', compact('lukisan', 'quantity', 'subtotalProduk', 'subtotalAsuransi', 'subtotalPengiriman', 'totalPembayaran'));
    }

    public function riwayatTransaksiAdminPage (){

        $user = Auth::user();
        $transaksis = Transaksi::all();

        return view('transaksi.riwayat-transaksi-admin', compact('transaksis'));
    }

    public function riwayatTransaksiMemberPage (){

        $user = Auth::user();
        // $transaksis = Transaksi::where('user_id', $user->id)->get();
        // $detailTransaksis = DetailTransaksi::where('transaksi_id', $transaksis->id)->get();
        $transaksis = Transaksi::with('detailTransaksis.lukisans')->where('user_id', $user->id)->get();

        return view('transaksi.riwayat-transaksi-member', compact('transaksis'));
    }

    public function detailTransaksiPage ($transaksiId){

        $user = Auth::user();
        $transaksi = Transaksi::findOrFail($transaksiId);

        $detailTransaksis = DB::table('detail_transaksis')
        ->join('transaksis', 'transaksi_id', "=", 'transaksis.id')
        ->join('lukisans', 'lukisan_id', "=", 'lukisans.id')
        ->join('users', 'lukisans.user_id', "=", 'users.id')
        ->where('transaksi_id', $transaksiId)->get();

        
        return view('transaksi.detail-transaksi', compact('transaksi', 'detailTransaksis', 'user'));
    }
}
