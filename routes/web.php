<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\HalamanUtamaController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LukisanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TentangController;
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

Route::get('/loginPage', [LoginController::class, 'LoginPage'])->middleware('guests');
Route::post('/login', [LoginController::class, 'Login'])->middleware('guests');
Route::get('/logout', [LoginController::class, 'Logout']);

Route::get('/', [HalamanUtamaController::class, 'HomePage']);
Route::get('/tentang', [TentangController::class, 'TentangPage']);

// Profil
Route::get('/profilPage/{id}', [UserController::class, 'profilPage']);
Route::post('/ubahPeran/{id}', [UserController::class, 'ubahPeran']);

// Lukisan
Route::get('/unggahLukisanPage', [LukisanController::class, 'unggahLukisanPage'])->middleware(3);
Route::post('/unggahLukisan', [LukisanController::class, 'unggahLukisan'])->middleware(3);

Route::get('/daftarLukisanPage', [LukisanController::class, 'daftarLukisanPage'])->middleware(3);

Route::get('/detailLukisanSenimanPage/{id}', [LukisanController::class, 'detailLukisanSenimanPage'])->middleware(3);
Route::get('/detailLukisanMemberPage/{id}', [LukisanController::class, 'detailLukisanMemberPage'])->middleware(2);
Route::get('/perbaruiLukisanPage/{id}', [LukisanController::class, 'perbaruiLukisanPage'])->middleware(3);
Route::post('/perbaruiLukisan/{id}', [LukisanController::class, 'perbaruiLukisan'])->middleware(3);
Route::post('/hapusLukisan/{id}', [LukisanController::class, 'hapusLukisan'])->middleware(3);

Route::get('/showLukisanSemua', [LukisanController::class,'showLukisan']);

Route::get('/search', [LukisanController::class,'searchResult']);

// Transaksi
Route::get('/checkoutPage', [TransaksiController::class, 'checkoutPage'])->middleware(2);

Route::get('/keranjang', [KeranjangController::class, 'KeranjangPage'])->middleware(2);

// Error Middleware
Route::get('/errorPage',[Controller::class, 'errorPage']);
