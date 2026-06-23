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
        Schema::create('pelanggans', function (Blueprint $table) {
            // Mengganti id() bawaan menjadi id_pelanggan sebagai Primary Key
            $table->id('id_pelanggan'); 
            
            // Nama pelanggan dibuat nullable (boleh kosong) untuk kebutuhan Custom
            $table->string('nama_pelanggan')->nullable(); 
            
            // Tanggal pesanan menggunakan tipe data date
            $table->date('tgl_pesanan'); 
            
            // Kolom created_at dan updated_at bawaan Laravel
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggans');
    }
};