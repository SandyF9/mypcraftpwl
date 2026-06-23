<?php
// Simpan di: app/Models/Pelanggan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    // SESUAIKAN DISINI: Ditambah 's' agar sama dengan nama tabel di migration
    protected $table = 'pelanggans';

    // Menentukan Primary Key yang bukan 'id'
    protected $primaryKey = 'id_pelanggan';

    // Kolom yang diizinkan untuk pengisian massal (Mass Assignment)
    protected $fillable = [
        'nama_pelanggan',
        'tgl_pesanan'
    ];

    // Mengatur tipe data (Casting)
    protected $casts = [
        'tgl_pesanan' => 'date', 
    ];
}