<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cabor_id');
            $table->string('tipe_prestasi')->nullable();
            $table->string('nama_event')->nullable();
            $table->string('nama_team')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('catatan')->nullable();
            $table->string('rekor')->nullable();
            $table->year('tahun')->nullable();
            $table->string('nomor_bukti_prestasi')->nullable();
            $table->string('file_bukti_prestasi')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('prestasi');
    }
}
