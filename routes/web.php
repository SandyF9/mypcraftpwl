<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;

// 1. Halaman awal (Landing Page/Welcome biasa)
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Dashboard (Hanya bisa diakses jika sudah login)
// Kita hubungkan ke DashboardController agar data grafik (revenue & orders) bisa tampil
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

// 3. Rute khusus Admin 
    Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('keuangans', KeuanganController::class);
    Route::resource('stocks', StockController::class);
    Route::resource('pelanggans', PelangganController::class);
});

require __DIR__.'/auth.php';