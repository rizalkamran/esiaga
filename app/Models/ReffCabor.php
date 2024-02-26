<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnggotaPeran;
use App\Models\Biodata;

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

    public function biodata()
    {
        return $this->hasMany(Biodata::class, 'cabor_id');
    }
}
