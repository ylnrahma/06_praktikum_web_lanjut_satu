<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\Matakuliah;
use Illuminate\Http\Request;

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

Route::resource('mahasiswas', MahasiswaController::class);
Route::get('/search', [MahasiswaController::class, 'search'])->name('search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/nilai/{mahasiswa_id}', [MahasiswaController::class, 'nilai'])->name('nilai');

Route::get('/nilai/{mahasiswa_id}/cetak_pdf',[MahasiswaController::class,'cetak_pdf'])->name('cetak_pdf');