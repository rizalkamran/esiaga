<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AnggotaAcaraRegistrasi;
use App\Models\AnggotaKehadiranRegistrasi;
use Illuminate\Support\Facades\Auth;
use App\Models\SesiAcara;
use App\Models\TandaTerima;
use App\Models\Kategori;
use App\Models\Galeri;

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
        'tipe',
    ];

    public function anggotaAcaraRegistrasi()
    {
        return $this->hasMany(AnggotaAcaraRegistrasi::class);
    }

    public function isRegisteredByUser($userId)
    {
        // Check if the user with the given ID is registered for this event
        return $this->anggotaAcaraRegistrasi()
            ->where('user_id', $userId)
            ->exists();
    }

    public function anggotaKehadiranRegistrasi()
    {
        return $this->hasMany(AnggotaKehadiranRegistrasi::class);
    }

    public function sesiAcara()
    {
        return $this->hasMany(SesiAcara::class, 'acara_id');
    }

    public function tandaTerima()
    {
        return $this->hasMany(TandaTerima::class, 'acara_id');
    }

    public function kategori()
    {
        return $this->hasMany(Kategori::class, 'acara_id');
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class, 'acara_id');
    }

    // Add a cast for the 'status_acara' attribute to ensure it is treated as an integer
    protected $casts = [
        'status_acara' => 'integer',
    ];
}
