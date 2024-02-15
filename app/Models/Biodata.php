<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model
use App\Models\ReffProvinsi; // Import the ReffProvinsi model
use App\Models\ReffKota; // Import the ReffKota model

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id',
        'provinsi_id',
        'kota_id',
        'telepon',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'nip_asn',
        'npwp',
        'alamat_jalan',
        'alamat_rt',
        'alamat_rw',
        'kecamatan',
        'kelurahan',
        'foto_diri',
        'foto_ktp',
        'foto_npwp',
        'status_anggota',
        'request_role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provinsi()
    {
        return $this->belongsTo(ReffProvinsi::class, 'provinsi_id');
    }

    public function kota()
    {
        return $this->belongsTo(ReffKota::class, 'kota_id');
    }
}
