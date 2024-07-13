<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Acara;

class Kategori extends Model
{
    use HasFactory;

    protected $table = 'kategori';

    protected $fillable = [
        'acara_id',
        'parent',
        'nama_kategori',
        'desk_tambahan',
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class);
    }
}
