<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReffCaborSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reff_cabor')->insert([
            'nama_cabor' => 'Basket',
        ]);

        DB::table('reff_cabor')->insert([
            'nama_cabor' => 'Sepak Bola'
        ]);

        DB::table('reff_cabor')->insert([
            'nama_cabor' => 'Renang'
        ]);

        DB::table('reff_cabor')->insert([
            'nama_cabor' => 'Bulu Tangkis'
        ]);
    }
}
