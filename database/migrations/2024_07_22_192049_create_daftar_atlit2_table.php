<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarAtlit2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_atlit2', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('reff_atlit_id');
            $table->unsignedBigInteger('kategori_id');
            $table->timestamps();

            // Foreign keys
            $table->foreign('reff_atlit_id')->references('id')->on('reff_atlit')->onDelete('cascade');
            $table->foreign('kategori_id')->references('id')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daftar_atlit2');
    }
}
