<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactionDetails extends Model
{
    use HasFactory;
    protected $table = 'transaksidetail';
    protected $fillable = ['id_transaksi', 'id_product', 'jumlah'];
}
