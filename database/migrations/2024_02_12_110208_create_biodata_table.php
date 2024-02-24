<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiodataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('kota_id');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('agama');
            $table->string('nip_asn')->nullable();
            $table->string('npwp')->nullable();
            $table->string('alamat_jalan');
            $table->string('alamat_rt');
            $table->string('alamat_rw');
            $table->string('kecamatan');
            $table->string('kelurahan');
            $table->string('gol_darah');
            $table->integer('tinggi_badan');
            $table->integer('berat_badan');
            $table->string('status_menikah');
            $table->string('hobi');
            $table->string('foto_diri')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_npwp')->nullable();
            $table->integer('status_anggota')->nullable();
            $table->integer('request_role')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kota_id')->references('id')->on('reff_kota')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biodata');
    }
}
