<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin1',
            'email' => 'admin1@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'staf1',
            'email' => 'staf1@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'staf2',
            'email' => 'staf2@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'staf3',
            'email' => 'staf3@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);
    }
}
