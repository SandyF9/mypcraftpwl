<?php

namespace App\App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganMasuk extends Model
{
    protected $table = 'keuangan_masuks'; // Sesuaikan jika nama tabelmu berbeda

    protected $fillable = [
        'tanggal',
        'nama',
        'kas',
        'modal',
    ];
}