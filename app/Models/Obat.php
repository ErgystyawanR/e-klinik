<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Transaksi;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obatalkes_m';

    public $timestamps = false;

    protected $fillable = ['nama_obat', 'last_modified']; // Sesuaikan dengan kolom-kolom yang ada di tabel

    // Tetapkan kolom 'last_modified' sebagai timestamp yang disimpan di dalam database
    protected $dates = ['last_modified'];

    protected $primaryKey = 'obatalkes_id';
    
    public $incrementing = true;
}
