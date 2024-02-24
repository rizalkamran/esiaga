<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Diklat extends Model
{
    use HasFactory;

    protected $table = 'diklat';

    protected $fillable = [
        'user_id',
        'tingkat',
        'nama_diklat',
        'tgl_mulai',
        'tgl_selesai',
        'jumlah_jam',
        'penyelenggara',
        'foto_ijazah',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
