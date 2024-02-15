<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;

    protected $table = 'acara';

    protected $fillable = [
        'nama_acara',
        'lokasi_acara',
        'tanggal_awal_acara',
        'tanggal_akhir_acara',
        'deskripsi_acara',
        'status_acara',
        'tingkat_wilayah_acara',
    ];

    // Add a cast for the 'status_acara' attribute to ensure it is treated as an integer
    protected $casts = [
        'status_acara' => 'integer',
    ];
}
