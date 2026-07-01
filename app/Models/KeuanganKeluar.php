<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganKeluar extends Model
{
    protected $table = 'keuangankeluars';

    protected $fillable = [
        'tanggal',
        'nama',
        'quantity',
        'harga_satuan',
        'jumlah',
        'keterangan'
    ];
}