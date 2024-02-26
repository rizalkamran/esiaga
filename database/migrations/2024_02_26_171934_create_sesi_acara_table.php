<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSesiAcaraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sesi_acara', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('acara_id');
            $table->string('sesi');
            $table->timestamps();


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
        Schema::dropIfExists('sesi_acara');
    }
}
