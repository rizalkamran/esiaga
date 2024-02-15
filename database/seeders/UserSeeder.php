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
            'name' => 'John 1',
            'email' => 'john1@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'John 2',
            'email' => 'john2@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'John 3',
            'email' => 'john3@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'John 4',
            'email' => 'john4@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);

        User::create([
            'name' => 'John 5',
            'email' => 'john5@gmail.com',
            'password' => Hash::make('123qwerty')
        ]);
    }
}
