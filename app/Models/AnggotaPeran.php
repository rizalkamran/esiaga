<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model
use App\Models\ReffPeran; // Import the ReffPeran model
use App\Models\ReffCabor; // Import the ReffCabor model


class AnggotaPeran extends Model
{
    use HasFactory;

    protected $table = 'anggota_peran';

    protected $fillable = [
        'user_id',
        'peran_id',
        'cabor_id',
        'jabatan',
        'status_aktif_peran',
        'status_verifikasi_peran',
        'nama_lembaga',
        'provinsi_lembaga',
        'kota_lembaga',
        'kecamatan_lembaga',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function peran()
    {
        return $this->belongsTo(ReffPeran::class, 'peran_id');
    }

    public function cabor()
    {
        return $this->belongsTo(ReffCabor::class, 'cabor_id');
    }
}
