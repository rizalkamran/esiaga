<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategoriTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kategori', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acara_id');
            $table->integer('parent')->nullable();
            $table->string('nama_kategori');
            $table->string('desk_tambahan')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('acara_id')->references('id')->on('acara')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kategori');
    }
}
