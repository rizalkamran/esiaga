<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarJuara2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_juara2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('daftar_atlit2_id');
            $table->unsignedBigInteger('reff_pemenang_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('daftar_atlit2_id')->references('id')->on('daftar_atlit2')->onDelete('cascade');
            $table->foreign('reff_pemenang_id')->references('id')->on('reff_pemenang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_juara2');
    }
}
