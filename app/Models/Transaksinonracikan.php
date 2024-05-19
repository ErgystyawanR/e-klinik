<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksinonracikan extends Model
{
    use HasFactory;
    protected $table = 'transaksi_nonracik'; 

    protected $fillable = [
        'no_transaksi',
        'nama_obat',
        'signa',
        'qty',
    ];
}
