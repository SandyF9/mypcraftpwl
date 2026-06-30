<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //Tentukan kolom database
    protected $fillable = [
    'name',
    'category',
    'brand',
    'stock',
    'release_date',
    'price',
];
}
