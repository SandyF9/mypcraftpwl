<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeuanganKas extends Model
{
    protected $table = 'keuangan_kas';


    protected $fillable = [
        'tanggal',
        'nama',
        'kas',
        'total',
    ];
}
