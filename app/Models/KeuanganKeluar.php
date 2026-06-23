<?php

namespace App\Http\Controllers; // Pastikan namespace sesuai dengan struktur folder kamu, biasanya App\Models; jika berada di folder Models

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganKas extends Model
{
    protected $table = 'keuangan_kas';

    protected $fillable = [
        'tanggal',
        'nama',
        'kas',
        'modal',       
        'total',
        'keterangan',
    ];
}