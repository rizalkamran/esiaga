<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReffPendidikanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Tidak Sekolah'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'SD/Sederajat'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'SMP/Sederajat'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'SMA/Sederajat'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Sarjana'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Magister'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Doktor'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Diploma I'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Diploma II'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Diploma III'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Diploma IV'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Lain-lain'
        ]);

        DB::table('reff_pendidikan')->insert([
            'nama_pendidikan' => 'Tidak ada data'
        ]);
    }
}
