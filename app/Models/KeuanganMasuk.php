<?php

namespace App\Models; // Diperbaiki dari App\App\Models agar tidak error

use Illuminate\Database\Eloquent\Model;

class KeuanganMasuk extends Model
{
    protected $table = 'keuangan_masuks';

    protected $fillable = [
        'tanggal',
        'nama',
        'kas',
        'modal',
        'total',       // Ditambahkan
        'keterangan',  // Ditambahkan
    ];
}