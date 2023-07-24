<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\DiskusiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LukisanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HalamanController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth (Login & Register)
Route::get('/daftarPage', [DaftarController::class, 'DaftarPage'])->middleware('guests');
Route::post('/daftar', [DaftarController::class, 'Daftar'])->middleware('guests');
Route::get('/get-cities/{provinceId}', [DaftarController::class, 'getKotaByProvinsi']);

Route::get('/loginPage', [LoginController::class, 'LoginPage'])->middleware('guests')->name('loginPage');
Route::post('/login', [LoginController::class, 'Login'])->middleware('guests');
Route::get('/logout', [LoginController::class, 'Logout']);

Route::get('/', [HalamanController::class, 'HomePage']);
Route::get('/tentang', [HalamanController::class, 'TentangPage']);
Route::get('/kontak', [HalamanController::class, 'KontakPage']);
Route::get('/syaratketentuan', [HalamanController::class, 'SyaratketentuanPage']);

// Profil
Route::get('/profilPage/{id}', [UserController::class, 'profilPage']);
Route::get('/ubahProfilPage/{id}', [UserController::class, 'ubahProfilPage']);
Route::post('/ubahProfil/{id}', [UserController::class, 'ubahProfil']);
Route::post('/ubahPeran/{id}', [UserController::class, 'ubahPeran']);

Route::get('/showSemuaSeniman', [UserController::class, 'showSeniman']);

Route::get('/detailSenimanPage/{id}', [UserController::class, 'detailSeniman']);

Route::get('/lihatSemuaAkun', [UserController::class, 'lihatSemuaAkun'])->middleware(1);
Route::put('/blokirAkun/{id}', [UserController::class, 'blokirAkun'])->middleware(1);

// Lukisan
Route::get('/unggahLukisanPage', [LukisanController::class, 'unggahLukisanPage'])->middleware(3);
Route::post('/unggahLukisan', [LukisanController::class, 'unggahLukisan'])->middleware(3);

Route::get('/daftarLukisanPage', [LukisanController::class, 'daftarLukisanPage'])->middleware(3);

Route::get('/detailLukisanSenimanPage/{id}', [LukisanController::class, 'detailLukisanSenimanPage'])->middleware(3);
Route::get('/detailLukisanMemberPage/{id}', [LukisanController::class, 'detailLukisanMemberPage']);
Route::get('/detailLukisanAdminPage/{id}', [LukisanController::class, 'detailLukisanAdminPage'])->middleware(1);
Route::get('/perbaruiLukisanPage/{id}', [LukisanController::class, 'perbaruiLukisanPage'])->middleware(3);
Route::post('/perbaruiLukisan/{id}', [LukisanController::class, 'perbaruiLukisan'])->middleware(3);
Route::post('/hapusLukisan/{id}', [LukisanController::class, 'hapusLukisan'])->middleware(3);

Route::get('/showLukisanSemua', [LukisanController::class, 'showLukisan']);
Route::get('/penilaianPage', [LukisanController::class, 'penilaianPage'])->middleware(2);
Route::get('/ulasanPage/{lukisanId}/{transaksiId}', [LukisanController::class, 'ulasanPage'])->middleware(2);
Route::post('/buatUlasan/{lukisanId}/{transaksiId}', [LukisanController::class, 'buatUlasan'])->middleware(2);
Route::get('/lihatSemuaUlasan/{id}', [LukisanController::class, 'lihatSemuaUlasan']);

Route::get('/search', [LukisanController::class, 'searchResult']);
Route::get('/kategori', [LukisanController::class, 'kategori']);


// Transaksi
Route::get('/checkoutPage/{id}', [TransaksiController::class, 'checkoutPage'])->middleware(2);
Route::get('/pembayaranPage/{lukisanId}/{quantity}', [TransaksiController::class, 'pembayaranPage'])->middleware(2);
Route::get('/riwayatTransaksiAdminPage', [TransaksiController::class, 'riwayatTransaksiAdminPage'])->middleware(1);
Route::get('/riwayatTransaksiMemberPage', [TransaksiController::class, 'riwayatTransaksiMemberPage'])->middleware(2);
Route::put('/batalkanPesanan/{id}', [TransaksiController::class, 'batalkanPesanan']);
Route::get('/detailTransaksiPage/{id}', [TransaksiController::class, 'detailTransaksiPage']);
Route::put('/unggahBuktiPembayaran/{id}', [TransaksiController::class, 'unggahBuktiPembayaran'])->middleware(2);
Route::put('/unggahBuktiPengiriman/{id}', [TransaksiController::class, 'unggahBuktiPengiriman'])->middleware(3);
Route::put('/unggahBuktiPelepasanDana/{id}', [TransaksiController::class, 'unggahBuktiPelepasanDana'])->middleware(1);
Route::put('/selesaikanPesanan/{id}', [TransaksiController::class, 'selesaikanPesanan']);
Route::put('/adminAccBuktiPembayaran/{id}', [TransaksiController::class, 'adminAccBuktiPembayaran'])->middleware(1);
Route::put('/adminDisBuktiPembayaran/{id}', [TransaksiController::class, 'adminDisBuktiPembayaran'])->middleware(1);
Route::get('/riwayatTransaksi', [TransaksiController::class, 'filter']);

// Keranjang
Route::get('/keranjang', [KeranjangController::class, 'KeranjangPage'])->middleware(2);
Route::post('/tambahkanKeKeranjang/{id}', [KeranjangController::class, 'tambahkanKeKeranjang'])->middleware(2);
Route::delete('/hapusItemKeranjang/{id}', [KeranjangController::class, 'hapusItemKeranjang'])->middleware(2);
Route::get('/checkoutKeranjangPage', [KeranjangController::class, 'checkoutKeranjangPage'])->middleware(2);
Route::get('/pembayaranKeranjangPage', [KeranjangController::class, 'pembayaranKeranjangPage'])->middleware(2);

// Pesanan Seniman
Route::get('/lihatSemuaPesanan', [TransaksiController::class, 'riwayatPesananSenimanPage'])->middleware(3);

// Diskusi
Route::get('/diskusiPage/{id}', [DiskusiController::class, 'DiskusiPage'])->middleware('someone');
Route::post('/diskusi', [DiskusiController::class, 'unggahDiskusi'])->middleware('someone');
Route::post('/diskusi/{id}', [DiskusiController::class, 'replyDiskusi'])->middleware('someone');

// Error Middleware
Route::get('/errorPage', [Controller::class, 'errorPage']);
