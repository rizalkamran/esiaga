<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReffCabor;

class Lisensi extends Model
{
    use HasFactory;

    protected $table = 'lisensi';

    protected $fillable = [
        'user_id',
        'cabor_id',
        'tingkat',
        'profesi',
        'nama_lisensi',
        'nomor_lisensi',
        'tgl_mulai',
        'tgl_selesai',
        'penyelenggara',
        'foto_lisensi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cabor()
    {
        return $this->belongsTo(ReffCabor::class, 'cabor_id');
    }
}
