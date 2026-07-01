<?php

namespace App\Models; 

use Illuminate\Database\Eloquent\Model;

class KeuanganMasuk extends Model
{
    protected $table = 'keuanganmasuks';

    protected $fillable = [
        'tanggal',
        'nama_produk',
        'quantity',
        'harga_satuan',
        'jumlah',
        'keterangan'
    ];
}