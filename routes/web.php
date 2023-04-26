<?php

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

// Route::get('/', 'App\Http\Controllers\HalamanUtamaController@HomePage');
Route::get('/', 'App\Http\Controllers\DetailLukisanController@LukisanPage');
Route::get('/login', 'App\Http\Controllers\LoginController@LoginPage');
Route::get('/daftar', 'App\Http\Controllers\DaftarController@DaftarPage'); 