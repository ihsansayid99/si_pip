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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/register-custom', 'RegisterController@register')->name('registernew');
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::middleware(['auth', 'ceklevel:admin'])->group(function(){
    Route::get('print-all-pengajuan', 'PengajuanController@printAllPengajuan')->name('admin.print.all');
    Route::get('print-all-siswa', 'SiswaController@printAllSiswa')->name('admin.print.siswa');
    Route::get('print-pengajuan-{id}', 'PengajuanController@printSinglePengajuan')->name('admin.print.detail');
    Route::get('list-siswa', 'SiswaController@index')->name('admin.siswa');
    Route::get('list-pengajuan', 'PengajuanController@index')->name('admin.pengajuan');
    Route::put('pengajuan-sukses/{id}', 'PengajuanController@ubahStatusSukses')->name('admin.pengajuan.success');
    Route::put('pengajuan-failed/{id}', 'PengajuanController@ubahStatusGagal')->name('admin.pengajuan.failed');
    Route::put('pengajuan-pending/{id}', 'PengajuanController@ubahStatusPending')->name('admin.pengajuan.pending');
});
Route::middleware(['auth', 'ceklevel:siswa'])->group(function(){
    Route::get('print-all-pengajuan-siswa', 'PengajuanController@printAllSiswaPengajuan')->name('siswa.print.all');
    Route::get('print-all-pengajuan-siswa-{id}', 'PengajuanController@printSingleSiswaPengajuan')->name('siswa.print.detail');
    Route::get('my-profile', 'SiswaController@myProfile')->name('siswa.profile');
    Route::post('my-profile/{id}', 'SiswaController@editMyProfile')->name('siswa.profile.update');
    Route::get('pengajuan/program', 'SiswaController@pengajuanSiswa')->name('siswa.pengajuan');
    Route::post('pengajuan/program', 'SiswaController@simpanPengajuanSiswa')->name('siswa.pengajuan.store');
});

