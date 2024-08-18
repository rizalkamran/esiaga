<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Acara;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'acara_id',
        'dokumentasi',
        'deskripsi',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'acara_id');
    }
}
