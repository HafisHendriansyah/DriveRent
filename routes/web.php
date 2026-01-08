<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\TransaksiController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth:admin');
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'store'])->name('register.store');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'proses'])->name('login.proses');
Route::get('login/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::group(['middleware' => 'auth:admin'], function () {
    //Pelanggan Routes
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan.index');
    Route::get('/pelanggan/tambah', [PelangganController::class, 'create'])->name('pelanggan.create');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->name('pelanggan.store');
    Route::get('/pelanggan/edit/{id}', [PelangganController::class, 'edit'])->name('pelanggan.edit');
    Route::put('/pelanggan/update/{id}', [PelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/destroy/{id}', [PelangganController::class, 'destroy'])->name('pelanggan.destroy');
});

Route::group(['middleware' => 'auth:admin'], function () {
    //Mobil Routes
    Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');
    Route::get('/mobil/tambah', [MobilController::class, 'create'])->name('mobil.create');
    Route::post('/mobil', [MobilController::class, 'store'])->name('mobil.store');
    Route::get('/mobil/edit/{id}', [MobilController::class, 'edit'])->name('mobil.edit');
    Route::put('/mobil/update/{id}', [MobilController::class, 'update'])->name('mobil.update');
    Route::delete('/mobil/destroy/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');
});

Route::group(['middleware' => 'auth:admin'], function () {
    //Transaksi Routes
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/tambah/{id_mobil}', [TransaksiController::class, 'create'])->name('transaksi.create');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
    Route::post('/transaksi/status/{id}', [TransaksiController::class, 'updateStatus'])->name('transaksi.updateStatus');
    Route::get('/laporan', [TransaksiController::class, 'laporan'])->name('laporan.index');
});
