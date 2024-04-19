<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\ReffCabor;

class Prestasi extends Model
{
    use HasFactory;

    protected $table = 'prestasi';

    protected $fillable = [
        'user_id',
        'cabor_id',
        'tipe_prestasi',
        'nama_event',
        'nama_team',
        'prestasi',
        'catatan',
        'rekor',
        'tahun',
        'nomor_bukti_prestasi',
        'file_bukti_prestasi',
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
