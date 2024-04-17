<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pendidikan;

class ReffPendidikan extends Model
{
    use HasFactory;

    protected $table = 'reff_pendidikan';

    protected $fillable = [
        'nama_pendidikan',
    ];

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class, 'pendidikan_id');
    }
}
