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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('user', 'UserController');
Route::get('/hapusdatauser/{id}', 'UserController@destroy');
Route::get('/getnamaadmin', 'BacabukuController@getnama')->name('getnama');

Route::resource('anggota', 'AnggotaController');
Route::get('/hapusdataanggota/{id}', 'AnggotaController@destroy');

Route::resource('buku', 'BukuController');
Route::get('/hapusdatabuku/{id}', 'BukuController@destroy');

Route::resource('peminjaman', 'PeminjamanController');
Route::get('/hapusdatapeminjaman/{id}', 'PeminjamanController@destroy');

Route::get('/pengembalianbuku/{id}', 'BacabukuController@kembali');
Route::get('/bukubelumdikembalikan/{id}', 'BacabukuController@belumkembali');

Route::get('/bacabuku', 'BacabukuController@index')->name('bacaBuku');
Route::get('/cetakqrcode/{id}', 'BacabukuController@cetakqrcode')->name('cetakqrcode');
Route::get('/cetakqrcodeCollection/{id}', 'BacabukuController@cetakqrcodeCollection')->name('cetakqrcodeCollection');