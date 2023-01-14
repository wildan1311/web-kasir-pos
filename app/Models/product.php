<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'stok',
        'harga_beli',
        'harga_jual',
        'kategori',
    ];
    protected $table = 'product';
}
