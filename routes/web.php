<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RotiController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\LaporanController;

// Redirect root ke halaman login
Route::get('/', function () {
    return redirect()->route('login');
});

// Semua route yang memerlukan login
Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Profile (bawaan Breeze)
    |--------------------------------------------------------------------------
    */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | CRUD Data Roti
    |--------------------------------------------------------------------------
    */
    Route::resource('roti', RotiController::class);

    /*
    |--------------------------------------------------------------------------
    | CRUD Data Penjualan
    |--------------------------------------------------------------------------
    */
    Route::resource('penjualan', PenjualanController::class);

    /*
    |--------------------------------------------------------------------------
    | Prediksi Penjualan
    |--------------------------------------------------------------------------
    */
    Route::get('/prediksi', [PrediksiController::class, 'index'])
        ->name('prediksi.index');

    Route::post('/prediksi/proses', [PrediksiController::class, 'proses'])
        ->name('prediksi.proses');

    /*
    |--------------------------------------------------------------------------
    | Grafik Prediksi
    |--------------------------------------------------------------------------
    */
    Route::get('/grafik', [PrediksiController::class, 'grafik'])
        ->name('grafik.index');

    /*
    |--------------------------------------------------------------------------
    | Laporan Penjualan
    |--------------------------------------------------------------------------
    */
    Route::get('/laporan', [LaporanController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])
        ->name('laporan.pdf');
});

// Route authentication bawaan Laravel Breeze
require __DIR__ . '/auth.php';