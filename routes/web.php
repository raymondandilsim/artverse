<?php

use App\Http\Controllers\DaftarController;
use App\Http\Controllers\HalamanUtamaController;
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
Route::get('/daftarPage', [DaftarController::class, 'DaftarPage']);
Route::post('/daftar', [DaftarController::class, 'Daftar']);

Route::get('/loginPage', [LoginController::class, 'LoginPage']);
Route::post('/login', [LoginController::class, 'Login']);
Route::get('/logout', [LoginController::class, 'Logout']);

Route::get('/', [HalamanUtamaController::class, 'HomePage']);
Route::get('/tentang', [TentangController::class, 'TentangPage']);

// Profil
Route::get('/profilPage/{id}', [UserController::class, 'profilPage']);
Route::post('/ubahPeran/{id}', [UserController::class, 'ubahPeran']);

// Lukisan
Route::get('/unggahLukisanPage', [LukisanController::class, 'unggahLukisanPage']);
Route::post('/unggahLukisan', [LukisanController::class, 'unggahLukisan']);

Route::get('/daftarLukisanPage', [LukisanController::class, 'daftarLukisanPage']);

Route::get('/detailLukisanSenimanPage/{id}', [LukisanController::class, 'detailLukisanSenimanPage']);
Route::get('/detailLukisanMemberPage/{id}', [LukisanController::class, 'detailLukisanMemberPage']);
Route::get('/perbaruiLukisanPage/{id}', [LukisanController::class, 'perbaruiLukisanPage']);
Route::post('/perbaruiLukisan/{id}', [LukisanController::class, 'perbaruiLukisan']);
Route::post('/hapusLukisan/{id}', [LukisanController::class, 'hapusLukisan']);

// Transaksi
Route::get('/checkoutPage', [TransaksiController::class, 'checkoutPage']);

