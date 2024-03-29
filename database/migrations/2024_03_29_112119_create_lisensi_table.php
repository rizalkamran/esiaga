<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLisensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lisensi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('cabor_id');
            $table->string('tingkat');
            $table->string('profesi')->nullable();
            $table->string('nama_lisensi')->nullable();
            $table->string('nomor_lisensi')->nullable();
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->string('penyelenggara');
            $table->string('foto_lisensi')->nullable();
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
        Schema::dropIfExists('lisensi');
    }
}
