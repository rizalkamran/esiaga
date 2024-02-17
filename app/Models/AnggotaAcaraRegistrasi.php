<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Acara;

class AnggotaAcaraRegistrasi extends Model
{
    use HasFactory;

    protected $table = 'anggota_acara_registrasi';

    protected $fillable = [
        'user_id',
        'acara_id',
        'qrcode_registrasi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }
}
