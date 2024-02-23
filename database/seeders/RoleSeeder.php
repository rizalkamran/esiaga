<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'name' => 'admin'
        ]);

        DB::table('roles')->insert([
            'name' => 'staf'
        ]);

        DB::table('roles')->insert([
            'name' => 'publik'
        ]);

        DB::table('roles')->insert([
            'name' => 'non-publik'
        ]);
    }
}
