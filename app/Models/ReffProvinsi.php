<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReffKota;
use App\Models\Biodata;

class ReffProvinsi extends Model
{
    use HasFactory;

    protected $table = 'reff_provinsi';

    public function kota()
    {
        return $this->hasMany(ReffKota::class, 'provinsi_id');
    }

    public function biodata()
    {
        return $this->hasMany(Biodata::class, 'provinsi_id');
    }
}
