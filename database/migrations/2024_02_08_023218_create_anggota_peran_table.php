<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnggotaPeranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota_peran', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('peran_id');
            $table->unsignedBigInteger('cabor_id');
            $table->string('jabatan', 100)->nullable();
            $table->boolean('status_aktif_peran');
            $table->boolean('status_verifikasi_peran');
            $table->string('nama_lembaga', 100);
            $table->string('provinsi_lembaga', 30);
            $table->string('kota_lembaga', 30);
            $table->string('kecamatan_lembaga', 30);

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Assuming the default Laravel users table
            $table->foreign('peran_id')->references('id')->on('reff_peran')->onDelete('cascade');
            $table->foreign('cabor_id')->references('id')->on('reff_cabor')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('anggota_peran');
    }
}
