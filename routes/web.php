<?php

use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\KategoriBukuController;
use App\Http\Controllers\KoleksiBukuController;
use App\Http\Controllers\PeminjamanBukuController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UlasanBukuController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::controller(BerandaController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/beranda', 'index')->name('beranda.index');
});

Route::controller(BukuController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/buku', 'index')->name('buku.index');
    Route::post('/buku/store', 'store')->name('buku.store');
    Route::get('/detail-buku/{buku}', 'show')->name('buku.show');
    Route::put('/buku/update/{buku}', 'update')->name('buku.update');
    Route::delete('/buku/destroy/{buku}', 'destroy')->name('buku.destroy');
    Route::post('/buku/{id}/koleksi', 'toggleKoleksi')->name('buku.toggleKoleksi');
});

Route::controller(KoleksiBukuController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/koleksi', 'index')->name('koleksi.index');
});

Route::controller(UlasanBukuController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::post('/ulasan/store', 'store')->name('ulasan.store');
});

Route::controller(PeminjamanBukuController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/transaksi', 'index')->name('transaksi.index');
    Route::get('/data-peminjaman', 'indexPetugas')->name('transaksi.indexPetugas');
    Route::post('/peminjaman/proses', 'store')->name('peminjaman.store');
    Route::delete('/peminjaman/destroy/{peminjaman}', 'destroy')->name('peminjaman.destroy');
});

Route::controller(PetugasController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/data-petugas', 'index')->name('petugas.index');
    Route::post('/data-petugas/store', 'store')->name('petugas.store');
    Route::delete('/data-petugas/destroy/{petugas}', 'destroy')->name('petugas.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
