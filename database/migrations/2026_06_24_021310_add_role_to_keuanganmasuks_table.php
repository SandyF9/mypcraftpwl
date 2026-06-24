<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah nama target tabel menjadi keuangankeluars
        Schema::table('keuangankeluars', function (Blueprint $table) {
            // Tempatkan kolom baru di sini jika ingin mengubah struktur tabel pengeluaran
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengubah nama target tabel menjadi keuangankeluars
        Schema::table('keuangankeluars', function (Blueprint $table) {
            // Tempatkan logika pembatalan perubahan di sini
        });
    }
};