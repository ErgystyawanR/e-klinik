<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksiracikan extends Model
{
    use HasFactory;
    
    protected $table = 'transaksi_racik'; 

    protected $fillable = [
        'no_transaksi',
        'nama_racikan',
        'signa',
    ];
}
