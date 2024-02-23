<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddAdditionalFieldsToUserTable2Table extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nomor_ktp')->unique()->nullable();
            $table->string('nama_lengkap');
            $table->string('jenis_kelamin');
            $table->string('telepon');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nomor_ktp');
            $table->dropColumn('nama_lengkap');
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('telepon');
        });
    }
}
