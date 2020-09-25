<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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


Auth::routes();

Route::get('/', function() {
    return redirect('dashboard');
});
Route::get('home', function () {
    return redirect('dashboard');
})->name('home');

Route::get('login', function () {
        return view('login');
})->name('login');

Route::get('dashboard', 'DashboardController@index');
Route::get('konteks_organisasi', 'KonteksOrganisasiController@index');
Route::get('konteks_organisasi/lihat/{id}', 'KonteksOrganisasiController@lihat');

Route::get('daftar_risiko', 'BDRJController@terkini')->name('daftar_risiko');
Route::get('daftar_risiko/lihat/{id}', 'BDRJController@lihat');
Route::get('daftar_risiko/semakan', 'BDRJController@senaraisemakan');
Route::get('daftar_risiko/borang/{id}', 'BDRJController@lihatBorang');

Route::get('logout', 'HomeController@logoutuser')->name('logout');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware(['pengguna'])->group(function() {
    Route::prefix('konteks_organisasi')->group(function () {
        Route::get('semakan', 'KonteksOrganisasiController@senaraisemakan');
        Route::get('semak/{id}', 'KonteksOrganisasiController@semak')->name('semakKonteksOrganisasi');
        Route::get('semak/{id}/selesai', 'KonteksOrganisasiController@semakBaru');
    });
    Route::prefix('daftar_risiko')->group(function () {
        Route::get('semakan/{id}', 'BDRJController@senaraisemakanborang');
        Route::get('semakan/{id}/{daftarrisikoid}', 'BDRJController@semak')->name('semakBDRJ');
        Route::get('semakan/{id}/{daftarrisikoid}/selesai', 'BDRJController@semakBaru')->name('hantarSemakBDRJ');
    });
});

Route::middleware(['urusetia'])->group(function() {
    Route::prefix('konteks_organisasi')->group(function () {
        Route::get('tetapan', 'KonteksOrganisasiController@senaraitetapan')->name('tetapanKonteks');
        Route::get('tambahIsu', 'KonteksOrganisasiController@tambahIsu');
        Route::get('tambahPihak', 'KonteksOrganisasiController@tambahPihak');
        Route::get('ubahtarikh', 'KonteksOrganisasiController@ubahtarikh');
        Route::get('hantar/{id}', 'KonteksOrganisasiController@hantar');
        Route::get('sejarah/{id}', 'KonteksOrganisasiController@sejarah');
    });
    Route::prefix('daftar_risiko')->group(function () {
        Route::get('tetapan', 'BDRJController@senaraitetapan');
    });
});

Route::middleware(['jk'])->group(function() {
    Route::prefix('konteks_organisasi')->group(function () {
        Route::get('pengesahan', 'KonteksOrganisasiController@senaraipengesahan');
        Route::get('sejarah', 'KonteksOrganisasiController@senaraisejarah');
    });
    Route::prefix('daftar_risiko')->group(function () {
        Route::get('pengesahan', 'BDRJController@senaraipengesahan');
        Route::get('sejarah', 'BDRJController@senaraisejarah');
    });
});

Route::get('test', 'TestControl@index');
