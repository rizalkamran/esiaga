<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReffPeranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reff_peran')->insert([
            'nama_peran' => 'Guru olahraga'
        ]);

        DB::table('reff_peran')->insert([
            'nama_peran' => 'Pelatih'
        ]);

        DB::table('reff_peran')->insert([
            'nama_peran' => 'Atlit'
        ]);

        DB::table('reff_peran')->insert([
            'nama_peran' => 'Official'
        ]);
    }
}
