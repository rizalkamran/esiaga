<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReffPemenang extends Model
{
    use HasFactory;

    protected $table = 'reff_pemenang';

    protected $fillable = [
        'deskripsi',
    ];
}
