<?php

namespace App\Http\Controllers;

use App\Models\DetailTransaksi;
use App\Models\Lukisan;
use App\Models\Transaksi;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class LukisanController extends Controller
{
    public function unggahLukisanPage()
    {
        return view('lukisan.unggah-lukisan');
    }

    public function unggahLukisan(Request $request)
    {
        $request->validate(
            [
                'namaLukisan' => 'required|string',
                'hargaLukisan' => 'required|numeric|min:0',
                'deskripsiLukisan' => 'required|string|max:2000',
                'stokLukisan' => 'required|numeric|min:1',
                'kondisiLukisan' => 'required',
                'beratLukisan' => 'required|numeric|min:1',
                'panjangLukisan' => 'required|numeric|min:1',
                'lebarLukisan' => 'required|numeric|min:1',
                'tinggiLukisan' => 'required|numeric|min:1',
                'gambarLukisan1' => 'required|mimes:jpg,jpeg,png',
                'gambarLukisan2' => 'mimes:jpg,jpeg,png',
                'gambarLukisan3' => 'mimes:jpg,jpeg,png',
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
                'kondisiLukisan.required' => 'Kondisi wajib diisi',
                'beratLukisan.required' => 'Kolom Berat lukisan harus terisi',
                'beratLukisan.numeric' => 'Kolom Berat lukisan harus dalam bentuk angka',
                'beratLukisan.min' => 'Berat lukisan harus minimal 1 gram',
                'panjangLukisan.required' => 'Kolom Panjang lukisan harus terisi',
                'panjangLukisan.numeric' => 'Kolom Panjang lukisan harus dalam bentuk angka',
                'panjangLukisan.min' => 'Panjang lukisan harus minimal 1 cm',
                'lebarLukisan.required' => 'Kolom Lebar lukisan harus terisi',
                'lebarLukisan.numeric' => 'Kolom Lebar lukisan harus dalam bentuk angka',
                'lebarLukisan.min' => 'Lebar lukisan harus minimal 1 cm',
                'tinggiLukisan.required' => 'Kolom Tinggi lukisan harus terisi',
                'tinggiLukisan.numeric' => 'Kolom Tinggi lukisan harus dalam bentuk angka',
                'tinggiLukisan.min' => 'Tinggi lukisan harus minimal 1 cm',
                'gambarLukisan1.required' => 'Kolom Gambar lukisan ke-1 harus terisi',
                'gambarLukisan1.mimes' => 'File Gambar 1 harus dalam bentuk .jpeg/.jpg/.png',
                'gambarLukisan2.mimes' => 'File Gambar 2 harus dalam bentuk .jpeg/.jpg/.png',
                'gambarLukisan3.mimes' => 'File Gambar 3 harus dalam bentuk .jpeg/.jpg/.png',

            ]
        );
        $user = Auth::user();

        $lukisan = new Lukisan();
        $user_id = $user->id;
        $nama_lukisan = $request->namaLukisan;
        $harga = $request->hargaLukisan;
        $deskripsi = $request->deskripsiLukisan;
        $stok = $request->stokLukisan;
        $kondisi = $request->input('kondisiLukisan');
        $berat = $request->beratLukisan;

        $panjang = $request->panjangLukisan;
        $lebar = $request->lebarLukisan;
        $tinggi = $request->tinggiLukisan;
        $ukuran = $panjang . ' x ' . $lebar . ' x ' . $tinggi;

        $gambarLukisan1 = $request->file('gambarLukisan1');
        $gambarLukisan1->store('/public/gambar-lukisan');
        $gambarLukisan1 = asset('storage/gambar-lukisan/' . $gambarLukisan1->hashName());
        $gambar1 = $gambarLukisan1;

        $gambarLukisan2 = $request->file('gambarLukisan2');
        if ($gambarLukisan2 == null) {
            $gambar2 = '';
        } else {
            $gambarLukisan2->store('/public/gambar-lukisan');
            $gambarLukisan2 = asset('storage/gambar-lukisan/' . $gambarLukisan2->hashName());
            $gambar2 = $gambarLukisan2;
        }

        $gambarLukisan3 = $request->file('gambarLukisan3');
        if ($gambarLukisan3 == null) {
            $gambar3 = '';
        } else {
            $gambarLukisan3->store('/public/gambar-lukisan');
            $gambarLukisan3 = asset('storage/gambar-lukisan/' . $gambarLukisan3->hashName());
            $gambar3 = $gambarLukisan3;
        }

        $lukisan->unggahLukisan($user_id, $nama_lukisan, $harga, $deskripsi, $stok, $kondisi, $berat, $ukuran, $gambar1, $gambar2, $gambar3);

        // ubah flag user
        $user = User::where('id', Auth::user()->id)->update(['flag' => 1]);

        return redirect('/unggahLukisanPage')->with('status', "Lukisan Berhasil Ditambahkan");
    }

    public function daftarLukisanPage()
    {
        $lukisans = Lukisan::where('user_id', auth()->user()->id)->paginate(10);

        return view('lukisan.daftar-lukisan', compact('lukisans'));
    }

    public function detailLukisanSenimanPage($id)
    {
        $lukisan = Lukisan::findOrFail($id);

        return view('lukisan.detail-lukisan-seniman', compact('lukisan'));
    }

    public function detailLukisanAdminPage($id)
    {
        $lukisan = Lukisan::findOrFail($id);

        return view('lukisan.detail-lukisan-admin', compact('lukisan'));
    }

    public function detailLukisanMemberPage($id)
    {
        $lukisan = Lukisan::findOrFail($id);

        return view('lukisan.detail-lukisan-member', compact('lukisan'));
    }

    public function perbaruiLukisanPage($id)
    {
        $lukisan = Lukisan::findOrFail($id);

        return view('lukisan.perbarui-lukisan', compact('lukisan'));
    }

    public function perbaruiLukisan(Request $request, $id)
    {
        $request->validate(
            [
                'namaLukisan' => 'required|string',
                'hargaLukisan' => 'required|numeric|min:0',
                'deskripsiLukisan' => 'required|string|max:2000',
                'stokLukisan' => 'required|numeric|min:1',
                'kondisiLukisan' => 'required',
                'beratLukisan' => 'required|numeric|min:1',
                'panjangLukisan' => 'required|numeric|min:1',
                'lebarLukisan' => 'required|numeric|min:1',
                'tinggiLukisan' => 'required|numeric|min:1',
                'gambarLukisan1' => 'required|mimes:jpg,jpeg,png',
                'gambarLukisan2' => 'mimes:jpg,jpeg,png',
                'gambarLukisan3' => 'mimes:jpg,jpeg,png',
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
                'kondisiLukisan.required' => 'Kondisi wajib diisi',
                'beratLukisan.required' => 'Kolom Berat lukisan harus terisi',
                'beratLukisan.numeric' => 'Kolom Berat lukisan harus dalam bentuk angka',
                'beratLukisan.min' => 'Berat lukisan harus minimal 1 gram',
                'panjangLukisan.required' => 'Kolom Panjang lukisan harus terisi',
                'panjangLukisan.numeric' => 'Kolom Panjang lukisan harus dalam bentuk angka',
                'panjangLukisan.min' => 'Panjang lukisan harus minimal 1 cm',
                'lebarLukisan.required' => 'Kolom Lebar lukisan harus terisi',
                'lebarLukisan.numeric' => 'Kolom Lebar lukisan harus dalam bentuk angka',
                'lebarLukisan.min' => 'Lebar lukisan harus minimal 1 cm',
                'tinggiLukisan.required' => 'Kolom Tinggi lukisan harus terisi',
                'tinggiLukisan.numeric' => 'Kolom Tinggi lukisan harus dalam bentuk angka',
                'tinggiLukisan.min' => 'Tinggi lukisan harus minimal 1 cm',
                'gambarLukisan1.required' => 'Kolom Gambar lukisan ke-1 harus terisi',
                'gambarLukisan1.mimes' => 'File Gambar 1 harus dalam bentuk .jpeg/.jpg/.png',
                'gambarLukisan2.mimes' => 'File Gambar 2 harus dalam bentuk .jpeg/.jpg/.png',
                'gambarLukisan3.mimes' => 'File Gambar 3 harus dalam bentuk .jpeg/.jpg/.png',

            ]
        );

        // retrieve old data dari Id lukisan
        $lukisanLama = Lukisan::findOrFail($id);

        // new data
        $namaLukisanBaru = $request->namaLukisan;
        $hargaLukisanBaru = $request->hargaLukisan;
        $deskripsiBaru = $request->deskripsiLukisan;
        $stokLukisanBaru = $request->stokLukisan;
        $kondisiLukisanBaru = $request->input('kondisiLukisan');
        $beratLukisanBaru = $request->beratLukisan;

        $panjang = $request->panjangLukisan;
        $lebar = $request->lebarLukisan;
        $tinggi = $request->tinggiLukisan;
        $ukuranLukisanBaru = $panjang . ' x ' . $lebar . ' x ' . $tinggi;

        $gambarLukisan1Baru = $request->file('gambarLukisan1');
        $this->deleteGambarPertamaFromDB($lukisanLama);
        $gambarLukisan1Baru->store('/public/gambar-lukisan');
        $gambarLukisan1Baru = asset('storage/gambar-lukisan/' . $gambarLukisan1Baru->hashName());

        $gambarLukisan2Baru = $request->file('gambarLukisan2');
        if ($gambarLukisan2Baru == null) {
            $gambarLukisan2Baru = $lukisanLama->gambar_kedua;
        } else {
            $this->deleteGambarKeduaFromDB($lukisanLama);
            $gambarLukisan2Baru->store('/public/gambar-lukisan');
            $gambarLukisan2Baru = asset('storage/gambar-lukisan/' . $gambarLukisan2Baru->hashName());
        }

        $gambarLukisan3Baru = $request->file('gambarLukisan3');
        if ($gambarLukisan3Baru == null) {
            $gambarLukisan3Baru = $lukisanLama->gambar_ketiga;
        } else {
            $this->deleteGambarKetigaFromDB($lukisanLama);
            $gambarLukisan3Baru->store('/public/gambar-lukisan');
            $gambarLukisan3Baru = asset('storage/gambar-lukisan/' . $gambarLukisan3Baru->hashName());
        }

        $lukisanLama->perbaruiLukisan(
            $id,
            $namaLukisanBaru,
            $hargaLukisanBaru,
            $deskripsiBaru,
            $stokLukisanBaru,
            $kondisiLukisanBaru,
            $beratLukisanBaru,
            $ukuranLukisanBaru,
            $gambarLukisan1Baru,
            $gambarLukisan2Baru,
            $gambarLukisan3Baru
        );

        return redirect('/daftarLukisanPage')->with('status', "Lukisan Berhasil Diperbarui");
    }

    public function deleteGambarPertamaFromDB($lukisan)
    {
        foreach (explode('/', $lukisan->gambar_pertama) as $item) {
            if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
                File::delete(public_path("storage/gambar-lukisan/" . $item));
            }
        }
    }

    public function deleteGambarKeduaFromDB($lukisan)
    {
        foreach (explode('/', $lukisan->gambar_kedua) as $item) {
            if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
                File::delete(public_path("storage/gambar-lukisan/" . $item));
            }
        }
    }

    public function deleteGambarKetigaFromDB($lukisan)
    {
        foreach (explode('/', $lukisan->gambar_ketiga) as $item) {
            if (str_ends_with($item, '.jpg') || str_ends_with($item, '.png') || str_ends_with($item, '.jpeg')) {
                File::delete(public_path("storage/gambar-lukisan/" . $item));
            }
        }
    }

    public function hapusLukisan($id)
    {
        $lukisan = Lukisan::findOrFail($id);

        $this->deleteGambarPertamaFromDB($lukisan);
        $this->deleteGambarKeduaFromDB($lukisan);
        $this->deleteGambarKetigaFromDB($lukisan);

        // delete data from DB
        $lukisan->hapusLukisanById($id);
        return redirect('/daftarLukisanPage')->with('status', "Lukisan Berhasil Dihapus");
    }

    public function showLukisan()
    {
        // $pagination = 9;
        // $lukisan = Lukisan::Paginate($pagination);
        $lukisan = Lukisan::join('users', 'users.id', '=', 'lukisans.user_id')
        ->where('users.flag', 1)
        ->paginate(9);
        return view('lukisan.lihat-semua-lukisan', ['lukisan' => $lukisan]);
    }

    public function searchResult(Request $request)
    {
        $search = $request->get('search');
        $lukisan = Lukisan::where('nama_lukisan', 'LIKE', "%$search%")->Paginate(6);
        return view('lukisan.search-result', ['lukisan' => $lukisan]);
    }

    public function penilaianPage()
    {

        $user = Auth::user();
        $transaksis = Transaksi::where('user_id', $user->id)->where('status', 'Selesai')->get();
        // $detailTransaksis = DetailTransaksi::where('transaksi_id', $transaksis->id)->get();
        // $lukisans = Lukisan::where('id', $detailTransaksis->lukisan_id)->get();

        $lukisans = collect(); // Initialize an empty collection

        foreach ($transaksis as $transaksi) {
            $detailTransaksis = DetailTransaksi::where('transaksi_id', $transaksi->id)->get();
            $lukisanIds = $detailTransaksis->pluck('lukisan_id');
            $lukisansForTransaksi = Lukisan::whereIn('id', $lukisanIds)->get();
            $lukisans = $lukisans->concat($lukisansForTransaksi);
        }

        $transaksi = DB::table('transaksis')
            ->join('detail_transaksis', 'transaksis.id', '=', 'detail_transaksis.transaksi_id')
            ->join('lukisans', 'detail_transaksis.lukisan_id', '=', 'lukisans.id')
            ->select(
                'transaksis.id as transaksi_id',
                'lukisans.id as lukisan_id',
                'lukisans.gambar_pertama as gambar_pertama',
                'lukisans.nama_lukisan',
                'transaksis.status',
                'transaksis.tanggal_pembelian'
            )
            ->where('transaksis.user_id', $user->id)
            ->where('transaksis.status', 'Selesai')
            ->paginate(10);

        return view('lukisan.penilaian', compact('transaksi'));
    }

    public function ulasanPage($lukisanId, $transaksiId)
    {
        $user = Auth::user();
        $transaksi = Transaksi::findorFail($transaksiId);
        $lukisan = Lukisan::findOrFail($lukisanId);
        $cekUlasan = Ulasan::where('user_id', $user->id)->where('transaksi_id', $transaksiId)->where('lukisan_id', $lukisanId)->first();

        return view('lukisan.ulasan', compact('lukisan', 'cekUlasan', 'transaksi'));
    }

    public function buatUlasan(Request $request, $lukisanId, $transaksiId)
    {

        $user = Auth::user();
        $bintang = $request->input('rating');
        $isi_ulasan = $request->ulasan;

        $request->validate(
            ['rating' => 'required',],
            ['rating.required' => 'Kolom Bintang harus terisi',]
        );

        $ulasan = new Ulasan();
        $ulasan->user_id = $user->id;
        $ulasan->transaksi_id = $transaksiId;
        $ulasan->lukisan_id = $lukisanId;
        $ulasan->bintang = $bintang;
        $ulasan->isi_ulasan = $isi_ulasan;
        $ulasan->save();

        return back()->with('status', 'Berhasil mengirim ulasan');
    }

    public function lihatSemuaUlasan($lukisanId){

        $lukisan = Lukisan::findOrFail($lukisanId);
        $ulasans = Ulasan::where('lukisan_id', $lukisanId)->paginate(10);

        $increment = 0;
        $jumlahBintang = 0;
        $totalBintang = 0;
        
        foreach ($ulasans as $ulasan) {
            $increment += 1;
            $jumlahBintang += $ulasan->bintang;
            $totalBintang = $jumlahBintang / $increment;
        }


        return view('lukisan.lihat-semua-ulasan', compact('ulasans', 'lukisan', 'totalBintang'));
    }
}
