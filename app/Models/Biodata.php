<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import the User model
use App\Models\ReffProvinsi; // Import the ReffProvinsi model
use App\Models\ReffKota; // Import the ReffKota model
use App\Models\ReffCabor; // Import the ReffKota model

class Biodata extends Model
{
    use HasFactory;

    protected $table = 'biodata';

    protected $fillable = [
        'user_id',
        'kota_id',
        'cabor_id',
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
        'gol_darah',
        'tinggi_badan',
        'berat_badan',
        'status_menikah',
        'hobi',
        'foto_diri',
        'foto_ktp',
        'foto_npwp',
        'foto_npwp',
        'upload_mandat',
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

    public function cabor()
    {
        return $this->belongsTo(ReffCabor::class, 'cabor_id');
    }
}
