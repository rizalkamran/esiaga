<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnggotaPeran;
use App\Models\AnggotaAcaraRegistrasi;

class ReffPeran extends Model
{
    use HasFactory;

    protected $table = 'reff_peran';

    protected $fillable = [
        'nama_peran',
    ];

    public function anggotaPeran()
    {
        return $this->hasMany(AnggotaPeran::class, 'peran_id');
    }

    public function registrasi()
    {
        return $this->hasMany(AnggotaAcaraRegistrasi::class, 'peran_id');
    }

}
