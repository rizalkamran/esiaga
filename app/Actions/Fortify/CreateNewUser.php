<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'unique:users', 'max:255', 'regex:/^\S*$/'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'nomor_ktp' => ['required', 'string', 'size:16', 'unique:users'],
            'nama_lengkap' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'telepon' => ['required', 'numeric'],
        ], [
            'name.regex' => 'Username dilarang memakai spasi',
            'nomor_ktp.required' => 'Nomor KTP wajib diisi',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi',
            'jenis_kelamin.required' => 'Jenis kelamin wajib diisi',
            'telepon.required' => 'Telepon wajib diisi',
            // Other custom error messages...
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'nomor_ktp' => $input['nomor_ktp'],
            'nama_lengkap' => $input['nama_lengkap'],
            'jenis_kelamin' => $input['jenis_kelamin'],
            'telepon' => $input['telepon'],
        ]);
    }
}
