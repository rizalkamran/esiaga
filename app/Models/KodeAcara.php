<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Acara;

class KodeAcara extends Model
{
    use HasFactory;

    protected $table = 'kode_acara';

    protected $fillable = [
        'acara_id', 'code'
    ];

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'acara_id');
    }
}
