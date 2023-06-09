<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Kota;
use App\Models\Lukisan;
use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
    public function checkoutPage(Request $request, $lukisanId){
        $user = Auth::user();
        $lukisan = Lukisan::findOrFail($lukisanId);
        
        // Asal Kota Penjual (Origin)
        // $kotaPenjual = $lukisan->user->kota->nama_kota;

        // Ubah Nama Kota jadi ID Kota biar bisa dihitung dengan API
        // $namaKotaOrigin = Kota::where('nama_kota', $kotaPenjual)->first();

        // if ($namaKotaOrigin) {
        //     $idOrigin = $namaKotaOrigin->id;
        // } else {
        //     $idOrigin = '';
        // }

        // Asal Kota Pembeli (Destination)
        // $kotaPembeli = $user->kota->nama_kota;

        // Ubah Nama Kota jadi ID Kota biar bisa dihitung dengan API
        // $namaKotaDestination = Kota::where('nama_kota', $kotaPembeli)->first();

        // if ($namaKotaDestination) {
        //     $idDestination = $namaKotaDestination->id;
        // } else {
        //     $idDestination = '';
        // }

        $quantity = request('quantity');
        
        // $origin = $idOrigin;
        $origin = $lukisan->user->kota_id;
        // $destination = $idDestination;
        $destination = $user->kota_id;
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

        return view('transaksi.checkout', compact('lukisan', 'quantity', 'cekOngkir'));
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

        $alamatDestinasi = $user->nama_jalan . ',' . $user->kota->nama_kota . ',' . $user->provinsi->provinsi . ',' . $user->kode_pos;

        $transaksi->user_id = $user->id;
        $transaksi->penjual_id = $lukisan->user_id;
        $transaksi->tanggal_pembelian = date('Y-m-d H:i:s');
        $transaksi->status = 'Belum Bayar';
        $transaksi->subtotal_pengiriman = $subtotalPengiriman;
        $transaksi->total_pembelian = $totalPembayaran;
        $transaksi->bukti_pembayaran = '';
        $transaksi->bukti_pengiriman = '';
        $transaksi->bukti_pelepasan_dana = '';
        $transaksi->save();

        $detailTransaksi->transaksi_id = $transaksi->id;
        $detailTransaksi->lukisan_id = $lukisan->id;
        $detailTransaksi->kuantitas = $quantity;
        $detailTransaksi->subtotal_produk = $subtotalProduk;
        $detailTransaksi->subtotal_asuransi = $subtotalAsuransi;
        $detailTransaksi->alamat_asal = $lukisan->user->kota->nama_kota;
        $detailTransaksi->alamat_destinasi = $alamatDestinasi;
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
        $transaksis = Transaksi::where('user_id', $user->id)->get();

        return view('transaksi.riwayat-transaksi-member', compact('transaksis'));
    }

    public function riwayatPesananSenimanPage (){

        $user = Auth::user();
        $transaksis = Transaksi::where('penjual_id', $user->id)->get();

        return view('transaksi.riwayat-transaksi-seniman', compact('transaksis'));
    }

    public function batalkanPesanan($transaksiId){
        $transaksi = Transaksi::where('id', $transaksiId)->first();

        $transaksi->status = 'Dibatalkan';
        $transaksi->save();

        return back()->with('status', 'Transaksi Berhasil Dibatalkan');
    }

    public function detailTransaksiPage ($transaksiId){

        $user = Auth::user();
        $transaksi = Transaksi::findOrFail($transaksiId);

        $detailTransaksis = DB::table('detail_transaksis')
        ->join('transaksis', 'transaksi_id', "=", 'transaksis.id')
        ->join('lukisans', 'lukisan_id', "=", 'lukisans.id')
        ->join('users', 'lukisans.user_id', "=", 'users.id')
        ->join('kotas', 'users.kota_id', "=", 'kotas.id')
        ->where('transaksi_id', $transaksiId)->get();

        $subtotalAsuransi = 0;
        $berat = 0;
        $subtotalProduk = 0;
        $asuransi = 0;

        foreach ($detailTransaksis as $item) {
            $asuransi = $item->kuantitas * (2 / 1000 * $item->harga);
            $subtotalAsuransi += $asuransi;
            $tempBerat = $item->kuantitas * $item->berat;
            $berat += $tempBerat;

            $subtotalProduk += $item->subtotal_produk;
        }

        $totalAsuransi = $subtotalAsuransi + 5000;

        return view('transaksi.detail-transaksi', compact('transaksi', 'detailTransaksis', 'user', 'berat','subtotalProduk', 'subtotalAsuransi', 'asuransi'));
    }

    public function deleteBuktiPembayaranFromDB($transaksi)
    {
        foreach (explode('/', $transaksi->bukti_pembayaran) as $item) {
            if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
                File::delete(public_path("storage/bukti-pembayaran/" . $item));
            }
        }
    }

    public function deleteBuktiPengirimanFromDB($transaksi)
    {
        foreach (explode('/', $transaksi->bukti_pengiriman) as $item) {
            if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
                File::delete(public_path("storage/bukti-pengiriman/" . $item));
            }
        }
    }

    public function deleteBuktiPelepasanDanaFromDB($transaksi)
    {
        foreach (explode('/', $transaksi->bukti_pelepasan_dana) as $item) {
            if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
                File::delete(public_path("storage/bukti-pelepasan-dana/" . $item));
            }
        }
    }

    public function adminAccBuktiPembayaran ($transaksiId){

        $transaksi = Transaksi::findOrFail($transaksiId);
        $detailTransaksi = DetailTransaksi::where('transaksi_id', $transaksiId)->get();

        if ($transaksi->bukti_pembayaran == '') {
            return back();
        } else {
            $transaksi->status = 'Dikemas';
            $transaksi->save();

            // kurangin kuantitas produk
            foreach ($detailTransaksi as $item) {
                $lukisan_id = $item->lukisan_id;
                $lukisan = Lukisan::findorFail($lukisan_id);
                $lukisan->stok = $lukisan->stok - $item->kuantitas;
                $lukisan->save();
            }

            return back()->with('status', 'Bukti Pembayaran berhasil disetujui.');
        }
        
    }

    public function adminDisBuktiPembayaran ($transaksiId){

        $transaksi = Transaksi::findOrFail($transaksiId);
        if ($transaksi->bukti_pembayaran == '') {
            return back();
        } else {
            $transaksi->status = 'Pembayaran Invalid';
            $transaksi->save();
            return back();
        }
    }

    public function unggahBuktiPembayaran (Request $request, $transaksiId){
        
        $transaksi = Transaksi::findOrFail($transaksiId);

        $buktiBayar = $request->file('buktiPembayaran');
        if ($buktiBayar == null) {
            $buktiPembayaran = '';
            return back()->with('error', 'Silahkan unggah bukti pembayaran.');
        } else {
            $this->deleteBuktiPembayaranFromDB($transaksi);
            $buktiBayar->store('/public/bukti-pembayaran');
            $buktiBayar = asset('storage/bukti-pembayaran/' . $buktiBayar->hashName());
            $buktiPembayaran = $buktiBayar;
            $transaksi->bukti_pembayaran = $buktiPembayaran;
            $transaksi->status = 'Menunggu Konfirmasi Pembayaran';
            $transaksi->save();
            return back()->with('status', 'Bukti Pembayaran berhasil diunggah.');
        }

    }

    public function unggahBuktiPengiriman(Request $request, $transaksiId){

        $transaksi = Transaksi::findOrFail($transaksiId);

        $buktiKirim = $request->file('buktiPengiriman');
        if ($buktiKirim == null) {
            $buktiPengiriman = '';
            return back()->with('error', 'Silahkan unggah bukti pengiriman.');
        } else {
            $this->deleteBuktiPengirimanFromDB($transaksi);
            $buktiKirim->store('/public/bukti-pengiriman');
            $buktiKirim = asset('storage/bukti-pengiriman/' . $buktiKirim->hashName());
            $buktiPengiriman = $buktiKirim;
            $transaksi->bukti_pengiriman = $buktiPengiriman;
            $transaksi->status = 'Dikirim';
            $transaksi->save();
            return back()->with('status', 'Bukti pengiriman berhasil diunggah.');
        }
    }

    public function unggahBuktiPelepasanDana(Request $request, $transaksiId){

        $transaksi = Transaksi::findOrFail($transaksiId);

        $buktiPelepasan = $request->file('buktiPelepasanDana');
        if ($buktiPelepasan == null) {
            $buktiPelepasanDana = '';
            return back()->with('error', 'Silahkan unggah bukti pelepasan dana.');
        } else {
            $this->deleteBuktiPelepasanDanaFromDB($transaksi);
            $buktiPelepasan->store('/public/bukti-pelepasan-dana');
            $buktiPelepasan = asset('storage/bukti-pelepasan-dana/' . $buktiPelepasan->hashName());
            $buktiPelepasanDana = $buktiPelepasan;
            $transaksi->bukti_pelepasan_dana = $buktiPelepasanDana;
            $transaksi->save();
            return back()->with('status', 'Bukti pelepasan dana berhasil diunggah.');
        }
    }

    public function selesaikanPesanan($transaksiId){
        
        $transaksi = Transaksi::findOrFail($transaksiId);

        $transaksi->status = 'Selesai';
        $transaksi->save();

        return back()->with('status', 'Terimakasih! Pesanan ini telah diselesaikan.');
    }

}
