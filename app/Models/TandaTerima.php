<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Acara;

class TandaTerima extends Model
{
    use HasFactory;

    protected $table = 'tanda_terima';

    protected $fillable = [
        'user_id',
        'acara_id',
        'status_baju',
        'status_sertifikat',
        'status_idcard',
        'bukti',
        'tgl_terima',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function acara()
    {
        return $this->belongsTo(Acara::class, 'acara_id');
    }
}
