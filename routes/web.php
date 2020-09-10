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

Route::get('daftar_risiko', 'BDRJController@index')->name('daftar_risiko');
Route::get('daftar_risiko/lihat/{id}', 'BDRJController@lihat');
Route::get('daftar_risiko/semakan', 'BDRJController@senaraisemakan');

Route::get('logout', 'HomeController@logoutuser')->name('logout');

Route::get('/redirect', 'Auth\LoginController@redirectToProvider');
Route::get('/callback', 'Auth\LoginController@handleProviderCallback');

Route::middleware(['pengguna'])->group(function() {
    Route::get('konteks_organisasi/semakan', 'KonteksOrganisasiController@senaraisemakan');
});

Route::middleware(['urusetia'])->group(function() {
    Route::get('konteks_organisasi/tetapan', 'KonteksOrganisasiController@senaraitetapan');
});

Route::middleware(['jk'])->group(function() {
    Route::get('konteks_organisasi/pengesahan', 'KonteksOrganisasiController@senaraipengesahan');
    Route::get('konteks_organisasi/sejarah', 'KonteksOrganisasiController@senaraisejarah');
});