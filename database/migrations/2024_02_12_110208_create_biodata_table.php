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
            $table->unsignedBigInteger('cabor_id');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('agama')->nullable();
            $table->string('nip_asn')->nullable();
            $table->string('npwp')->nullable();
            $table->string('alamat_jalan')->nullable();
            $table->string('alamat_rt')->nullable();
            $table->string('alamat_rw')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kelurahan')->nullable();
            $table->string('gol_darah')->nullable();
            $table->integer('tinggi_badan')->nullable();
            $table->integer('berat_badan')->nullable();
            $table->string('status_menikah')->nullable();
            $table->string('hobi')->nullable();
            $table->string('foto_diri')->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_npwp')->nullable();
            $table->string('upload_mandat')->nullable();
            $table->integer('status_anggota')->nullable();
            $table->integer('request_role')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('kota_id')->references('id')->on('reff_kota')->onDelete('cascade');
            $table->foreign('cabor_id')->references('id')->on('reff_cabor')->onDelete('cascade');
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
