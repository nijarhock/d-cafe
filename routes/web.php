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

Route::get('/', function () {
    if(!Auth::check()) {
        return redirect()->route('login');
    } else {
        return redirect()->route('dashboard');
    }
});

Route::get('/login', "LoginController@index")->name('login');
Route::post('/authentication', 'LoginController@authentication');

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware("auth.basic");

Route::get('/user/create', 'UserController@create')->middleware("auth.basic");
Route::post('/user/store', 'UserController@store')->middleware("auth.basic");
Route::get('/user', 'UserController@index')->middleware("auth.basic");
Route::post('/user/show', 'UserController@show')->middleware("auth.basic");
Route::post('/user/update', 'UserController@update')->middleware("auth.basic");
Route::post('/user/destroy', 'UserController@destroy')->middleware("auth.basic");

Route::get('/jenis_byr/create', 'JenisBayarController@create')->middleware("auth.basic");
Route::post('/jenis_byr/store', 'JenisBayarController@store')->middleware("auth.basic");
Route::get('/jenis_byr', 'JenisBayarController@index')->middleware("auth.basic");
Route::post('/jenis_byr/show', 'JenisBayarController@show')->middleware("auth.basic");
Route::post('/jenis_byr/update', 'JenisBayarController@update')->middleware("auth.basic");
Route::post('/jenis_byr/destroy', 'JenisBayarController@destroy')->middleware("auth.basic");

Route::get('/konsumen_kategori/create', 'KonsumenKategoriController@create')->middleware("auth.basic");
Route::post('/konsumen_kategori/store', 'KonsumenKategoriController@store')->middleware("auth.basic");
Route::get('/konsumen_kategori', 'KonsumenKategoriController@index')->middleware("auth.basic");
Route::post('/konsumen_kategori/show', 'KonsumenKategoriController@show')->middleware("auth.basic");
Route::post('/konsumen_kategori/update', 'KonsumenKategoriController@update')->middleware("auth.basic");
Route::post('/konsumen_kategori/destroy', 'KonsumenKategoriController@destroy')->middleware("auth.basic");

Route::get('/konsumen/create', 'KonsumenController@create')->middleware("auth.basic");
Route::post('/konsumen/store', 'KonsumenController@store')->middleware("auth.basic");
Route::get('/konsumen', 'KonsumenController@index')->middleware("auth.basic");
Route::post('/konsumen/show', 'KonsumenController@show')->middleware("auth.basic");
Route::post('/konsumen/update', 'KonsumenController@update')->middleware("auth.basic");
Route::post('/konsumen/destroy', 'KonsumenController@destroy')->middleware("auth.basic");

Route::get('/meja/create', 'MejaController@create')->middleware("auth.basic");
Route::post('/meja/store', 'MejaController@store')->middleware("auth.basic");
Route::get('/meja', 'MejaController@index')->middleware("auth.basic");
Route::post('/meja/show', 'MejaController@show')->middleware("auth.basic");
Route::post('/meja/update', 'MejaController@update')->middleware("auth.basic");
Route::post('/meja/destroy', 'MejaController@destroy')->middleware("auth.basic");

Route::get('/menu_kategori/create', 'MenuKategoriController@create')->middleware("auth.basic");
Route::post('/menu_kategori/store', 'MenuKategoriController@store')->middleware("auth.basic");
Route::get('/menu_kategori', 'MenuKategoriController@index')->middleware("auth.basic");
Route::post('/menu_kategori/show', 'MenuKategoriController@show')->middleware("auth.basic");
Route::post('/menu_kategori/update', 'MenuKategoriController@update')->middleware("auth.basic");
Route::post('/menu_kategori/destroy', 'MenuKategoriController@destroy')->middleware("auth.basic");

Route::get('/menu/create', 'MenuController@create')->middleware("auth.basic");
Route::post('/menu/store', 'MenuController@store')->middleware("auth.basic");
Route::get('/menu', 'MenuController@index')->middleware("auth.basic");
Route::post('/menu/show', 'MenuController@show')->middleware("auth.basic");
Route::post('/menu/update', 'MenuController@update')->middleware("auth.basic");
Route::post('/menu/destroy', 'MenuController@destroy')->middleware("auth.basic");
Route::post('/menu/cari', 'MenuController@cari')->middleware("auth.basic");

Route::get('/pesanan', 'PesananController@index')->middleware("auth.basic");
Route::get('/pesanan/proses', 'PesananController@proses')->middleware("auth.basic");
Route::get('/pesanan/batal', 'PesananController@batal')->middleware("auth.basic");
Route::post('/pesanan/proses_batal', 'PesananController@proses_batal')->middleware("auth.basic");
Route::post('/pesanan/show', 'PesananController@show')->middleware("auth.basic");
Route::post('/pesanan/check_lanjut', 'PesananController@check_lanjut')->middleware("auth.basic");
Route::post('/pesanan/detail', 'PesananController@detail')->middleware("auth.basic");
Route::post('/pesanan/store', 'PesananController@store')->middleware("auth.basic");
Route::post('/pesanan/store_detail', 'PesananController@store_detail')->middleware("auth.basic");
Route::post('/pesanan/update_detail', 'PesananController@update_detail')->middleware("auth.basic");
Route::post('/pesanan/hapus_detail', 'PesananController@hapus_detail')->middleware("auth.basic");
Route::post('/pesanan/simpan_bayar', 'PesananController@simpan_bayar')->middleware("auth.basic");
Route::get('/print_dapur', 'PesananController@print_dapur')->middleware("auth.basic");
Route::get('/print_invoice', 'PesananController@print_invoice')->middleware("auth.basic");

Route::get('/laporan/pesanan', 'LaporanController@pesanan')->middleware("auth.basic");
Route::post('/laporan/detail_pesanan', 'LaporanController@detail_pesanan')->middleware("auth.basic");
Route::get('/laporan/stok_min', 'LaporanController@stok_min')->middleware("auth.basic");
Route::get('/laporan/bayar', 'LaporanController@bayar')->middleware("auth.basic");
Route::post('/laporan/detail_bayar', 'LaporanController@detail_bayar')->middleware("auth.basic");
Route::get('/laporan/detail', 'LaporanController@detail')->middleware("auth.basic");
Route::post('/laporan/detail_detail', 'LaporanController@detail_detail')->middleware("auth.basic");

Route::get('/logs', 'LaporanController@logs')->middleware("auth.basic");
Route::post('/detail_logs', 'LaporanController@detail_logs')->middleware("auth.basic");

Route::get('/logout', function() {
    Auth::logout();

    return redirect()->route('login');
});