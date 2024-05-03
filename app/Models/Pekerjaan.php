<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Pekerjaan extends Model
{
    use HasFactory;

    protected $table = 'pekerjaan';

    protected $fillable = [
        'user_id',
        'pekerjaan',
        'jabatan',
        'nama_instansi',
        'alamat_instansi',
        'kontak_instansi',
        'tipe_kerja',
        'status_kerja',
        'tgl_mulai',
        'tgl_selesai',
        'bukti_kerja',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
