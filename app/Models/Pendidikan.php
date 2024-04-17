<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReffPendidikan;

class Pendidikan extends Model
{
    use HasFactory;

    protected $table = 'pendidikan';

    protected $fillable = [
        'user_id',
        'pendidikan_id',
        'gelar_depan',
        'gelar_belakang',
        'nama_sekolah',
        'nama_jurusan',
        'tahun_lulus',
        'ijazah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reffPendidikan()
    {
        return $this->belongsTo(ReffPendidikan::class, 'pendidikan_id');
    }
}
