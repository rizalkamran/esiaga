<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kategori;

class DaftarJuara extends Model
{
    use HasFactory;

    protected $table = 'daftar_juara';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'status_juara',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
