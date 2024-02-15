<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnggotaPeran;

class ReffCabor extends Model
{
    use HasFactory;

    protected $table = 'reff_cabor';

    protected $fillable = [
        'nama_cabor',
        'deskripsi_cabor',
    ];

    public function anggotaPeran()
    {
        return $this->hasMany(AnggotaPeran::class, 'cabor_id');
    }
}
