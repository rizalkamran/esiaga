<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('acara', function (Blueprint $table) {
            $table->id();
            $table->string('nama_acara');
            $table->string('lokasi_acara');
            $table->date('tanggal_awal_acara');
            $table->date('tanggal_akhir_acara');
            $table->text('deskripsi_acara');
            $table->unsignedInteger('status_acara')->default(0);;
            $table->string('tingkat_wilayah_acara');
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
        Schema::dropIfExists('acara');
    }
}
