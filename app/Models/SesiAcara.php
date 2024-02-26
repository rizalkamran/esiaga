<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Acara;

class SesiAcara extends Model
{
    use HasFactory;

    protected $table = 'sesi_acara';

    protected $fillable = [
        'acara_id',
        'sesi',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'acara_id');
    }

    public function anggotaKehadiranRegistrasi()
    {
        return $this->hasMany(AnggotaKehadiranRegistrasi::class, 'sesi_acara_id');
    }
}
