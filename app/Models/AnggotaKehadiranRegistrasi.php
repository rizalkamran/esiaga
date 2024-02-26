<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SesiAcara;

class AnggotaKehadiranRegistrasi extends Model
{
    use HasFactory;

    protected $table = 'anggota_kehadiran_registrasi';

    protected $fillable = [
        'user_id',
        'sesi_acara_id',
    ];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sesiAcara()
    {
        return $this->belongsTo(SesiAcara::class, 'sesi_acara_id');
    }
}
