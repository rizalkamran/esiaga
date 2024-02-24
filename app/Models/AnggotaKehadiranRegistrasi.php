<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaKehadiranRegistrasi extends Model
{
    use HasFactory;

    protected $table = 'anggota_kehadiran_registrasi';

    protected $fillable = [
        'user_id',
        'acara_id',
    ];

    // Define the relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }
}
