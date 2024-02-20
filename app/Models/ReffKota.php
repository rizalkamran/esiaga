<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReffProvinsi;
use App\Models\Biodata;
use App\Models\AnggotaPeran;

class ReffKota extends Model
{
    use HasFactory;

    protected $table = 'reff_kota';

    public function provinsi()
    {
        return $this->belongsTo(ReffProvinsi::class, 'provinsi_id');
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class, 'kota_id');
    }

    public function anggotaPeran()
    {
        return $this->hasMany(AnggotaPeran::class, 'kota_id');
    }

}
