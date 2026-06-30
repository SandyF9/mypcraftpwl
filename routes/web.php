<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\KeuanganKeluarController;
use App\Http\Controllers\KeuanganMasukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

// 1. Halaman awal (Landing Page/Welcome biasa)
Route::get('/', function () {
    return view('welcome');
});

// 2. Halaman Dashboard (Hanya bisa diakses jika sudah login)
// Kita hubungkan ke DashboardController agar data grafik (revenue & orders) bisa tampil
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware(['auth'])
        ->name('dashboard');

// 3. Rute khusus Admin 
    Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class)->except(['show']);
    Route::resource('keuangan-masuks', KeuanganMasukController::class);
    Route::resource('keuangan-keluars', KeuanganKeluarController::class);
    
    // 4. Kemungkianan tidak digunakan
    Route::resource('pelanggans', PelangganController::class);
    
});

require __DIR__.'/auth.php';