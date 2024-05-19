<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksiracikandetail extends Model
{
    use HasFactory;
    protected $table = 'transaksi_racikan_detail'; 

    protected $fillable = [
        'no_transaksi',
        'nama_obat',
        'qty',
    ];
}
