<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Keranjang;
use App\Models\Kota;
use App\Models\Lukisan;
use App\Models\Transaksi;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redis;

class KeranjangController extends Controller
{
    public function KeranjangPage(Request $request)
    {
        $user = Auth::user();
        $keranjang = Keranjang::where('user_id', $user->id)->get();

        return view('transaksi.keranjang', compact('keranjang'));
    }

    public function hapusItemKeranjang($id)
    {
        Keranjang::find($id)->delete(); 

        return back()->with('status', 'Lukisan telah dihapus dari Keranjang');
    }

    public function tambahkanKeKeranjang(Request $request, $lukisanId)
    {
        $user = Auth::user();
        $lukisan = Lukisan::where('id', $lukisanId)->first();

        $keranjangItem = Keranjang::where('user_id', $user->id)->where('lukisan_id', $lukisanId)->first();

        if ($keranjangItem) {
            $keranjangItem->kuantitas += $request->quantity;
            if($keranjangItem->kuantitas > $lukisan->stok){
                $keranjangItem->kuantitas -= $request->quantity;
            }
            $keranjangItem->subtotal_produk = $keranjangItem->kuantitas * $lukisan->harga;
            $keranjangItem->save();
        } else {
            $keranjang = new Keranjang();
            $keranjang->user_id = $user->id;
            $keranjang->lukisan_id = $lukisanId;
            $keranjang->kuantitas = $request->quantity;
            $keranjang->subtotal_produk = $request->quantity * $lukisan->harga;
            $keranjang->save();
        }
        
        return redirect('/keranjang')->with('status', 'Lukisan berhasil ditambahkan ke Keranjang');
    }

    public function checkoutKeranjangPage(Request $request){

        $user = Auth::user();
        $itemKeranjang = Keranjang::where('user_id', $user->id)->get();

        foreach ($itemKeranjang as $item) {
            $lukisan = Lukisan::where('id', $item->lukisan_id)->first();
        }

        $expectedSellerId = null;
        $temp = null;

        foreach ($itemKeranjang as $item) {

            if ($expectedSellerId === null) {
                // Set the expected seller ID to the seller ID of the first product
                $expectedSellerId = $item->lukisan->user->id;
            } elseif ($expectedSellerId !== $item->lukisan->user->id) {
                return back()->with('error', 'Maaf pembayaran hanya bisa dilakukan dengan 1 penjual/seniman yang sama. Silahkan hapus lukisan seniman lain yang tidak diinginkan terlebih dahulu.');
            } 
        }

        foreach ($itemKeranjang as $item) {
            // Asal Kota Penjual (Origin)
            $kotaPenjual = $item->lukisan->user->nama_kota;

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

            $origin = $idOrigin;
            $destination = $idDestination;
            
            $weight = $item->kuantitas * $item->lukisan->berat;
            $temp = $temp + $weight;
        }

        $response = Http::asForm()->withHeaders([
                'key' => 'a6af13d8694b086e5148df4cb5693e79'
            ])->post('https://api.rajaongkir.com/starter/cost', [
                'origin' => $origin,
                'destination' => $destination,
                'weight' => $temp,
                'courier' => 'jne'
            ]);

        $cekOngkir = $response['rajaongkir']['results'][0]['costs'];

        return view('transaksi.checkout-keranjang', compact('itemKeranjang', 'cekOngkir', 'lukisan'));
    }

    public function pembayaranKeranjangPage(Request $request)
    {
        $transaksi = new Transaksi();
        
        $user = Auth::user();
        $itemKeranjang = Keranjang::where('user_id', $user->id)->get();

        $hargaAsuransi = [];
        $subtotalAsuransi = 0;
        $berat = 0;
        $subtotalProduk = 0;

        foreach ($itemKeranjang as $item) {
            $asuransi = $item->kuantitas * (2 / 1000 * $item->lukisan->harga);
            $hargaAsuransi[$item->id] = $asuransi;
            $subtotalAsuransi += $asuransi;
            $tempBerat = $item->kuantitas * $item->lukisan->berat;
            $berat += $tempBerat;

            $subtotalProduk += $item->subtotal_produk;
        }

        $totalAsuransi = $subtotalAsuransi + 5000;
        $subtotalPengiriman = $request->jenisPengiriman;
        $totalPembayaran = $subtotalProduk + $subtotalPengiriman + $totalAsuransi;
        $catatans = $request->input('catatan');

        $alamatDestinasi = $user->nama_jalan . ',' . $user->nama_kota . ',' . $user->nama_provinsi . ',' . $user->kode_pos;

        $transaksi->user_id = $user->id;
        $transaksi->tanggal_pembelian = date('Y-m-d H:i:s');
        $transaksi->status = 'Belum Bayar';
        $transaksi->subtotal_pengiriman = $subtotalPengiriman;
        $transaksi->total_pembelian = $totalPembayaran;
        $transaksi->bukti_pembayaran = '';
        $transaksi->bukti_pengiriman = '';
        $transaksi->bukti_pelepasan_dana = '';
        $transaksi->save();

        foreach ($itemKeranjang as $item) {
            $asuransi = $item->kuantitas * (2 / 1000 * $item->lukisan->harga);

            $detailTransaksi = new DetailTransaksi();
            $detailTransaksi->transaksi_id = $transaksi->id;
            $detailTransaksi->lukisan_id = $item->lukisan->id;
            $detailTransaksi->kuantitas = $item->kuantitas;
            $detailTransaksi->subtotal_produk = $item->subtotal_produk;
            $detailTransaksi->subtotal_asuransi = $asuransi;
            $detailTransaksi->alamat_asal = $item->lukisan->user->nama_kota;
            $detailTransaksi->alamat_destinasi = $alamatDestinasi;
            $detailTransaksi->catatan = $catatans[$item->id];
            $detailTransaksi->save();
        }

        //Kosongkan cart
        $emptyCart = DB::table('keranjangs')->where('user_id', $user->id)->delete();

        return view('transaksi.pembayaran-keranjang', compact('catatans', 'itemKeranjang', 'subtotalPengiriman', 'hargaAsuransi', 'subtotalAsuransi', 'berat', 'totalPembayaran', 'subtotalProduk'));
    }
}
