<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;
use App\Models\AnggotaPeran;
use App\Models\AnggotaAcaraRegistrasi;
use App\Models\anggotaKehadiranRegistrasi;
use App\Models\Biodata;
use App\Models\Diklat;
use App\Models\Lisensi;
use App\Models\Pendidikan;
use App\Models\Prestasi;
use App\Models\Pekerjaan;
use App\Models\TandaTerima;
use App\Models\ReffAtlit;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'nomor_ktp',
        'nama_lengkap',
        'jenis_kelamin',
        'telepon',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    } */


    /* public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    } */

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if user has a role
     *
     * @param string $role
     * @return boolean
     */
    public function hasAnyRole(string $role)
    {
        return null !== $this->roles()->where('name', $role)->first();
    }

    /**
     * Check the user has any given a role
     *
     * @param array $role
     * @return boolean
     */
    public function hasAnyRoles(array $role)
    {
        return null !== $this->roles()->whereIn('name', $role)->first();
    }

    public function anggotaPeran()
    {
        return $this->hasMany(AnggotaPeran::class, 'user_id');
    }

    public function anggotaAcaraRegistrasi()
    {
        return $this->hasMany(AnggotaAcaraRegistrasi::class);
    }

    public function anggotaKehadiranRegistrasi()
    {
        return $this->hasMany(AnggotaKehadiranRegistrasi::class);
    }

    public function biodata()
    {
        return $this->hasOne(Biodata::class);
    }

    public function diklat()
    {
        return $this->hasMany(Diklat::class);
    }

    public function lisensi()
    {
        return $this->hasMany(Lisensi::class);
    }

    public function pendidikan()
    {
        return $this->hasMany(Pendidikan::class);
    }

    public function prestasi()
    {
        return $this->hasMany(Prestasi::class);
    }

    public function pekerjaan()
    {
        return $this->hasMany(Pekerjaan::class);
    }

    public function tandaTerima()
    {
        return $this->hasMany(TandaTerima::class);
    }

    public function reffAtlit()
    {
        return $this->hasMany(ReffAtlit::class);
    }
}
