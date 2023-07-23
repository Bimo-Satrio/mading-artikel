<?php

use App\Http\Controllers\artikelController;
use App\Models\artikelModel;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




Auth::routes();

//halaman user
Route::get('/', [artikelController::class, 'beranda'])->name('beranda');
Route::get('/baca-artikel/{id_artikel}', [artikelController::class, 'bacaArtikel'])->name('baca-artikel');
Route::POST('/tambah-komentar', [artikelController::class, 'tambahKomentar'])->name('tambah-komentar');
Route::GET('/pencarian', [artikelController::class, 'pencarian'])->name('pencarian');
//akhir halaman user


//halaman admin
Route::middleware(['web', 'auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', [artikelController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/data-artikel', [artikelController::class, 'dataArtikel'])->name('data-artikel');
    Route::get('/admin/post-artikel', [artikelController::class, 'postArtikel'])->name('post-artikel');
    Route::post('/admin/add-post-artikel', [artikelController::class, 'addPostArtikel'])->name('add-post-artikel');
    Route::POST('/admin/hapus-artikel/{id_artikel}', [artikelController::class, 'hapusArtikel'])->name('hapus-artikel');
    Route::get('/admin/ubah-artikel/{id_artikel}', [artikelController::class, 'ubahArtikel'])->name('ubah-artikel');
    Route::get('/admin/laporan-artikel', [artikelController::class, 'laporanArtikel'])->name('laporan-artikel');
    Route::get('/admin/komentar/{id_artikel}', [artikelController::class, 'kelolaKomentar'])->name('komentar');
    Route::POST('/admin/hapusKomentar/{id_artikel}', [artikelController::class, 'hapusKomentar'])->name('hapus-komentar');
});
//akhir halaman admin
