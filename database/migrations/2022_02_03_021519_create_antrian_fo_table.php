<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntrianFoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antrian_fo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('antrian_fo_id');
            $table->string('tujuan')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nomor_antrian')->nullable();
            $table->string('kategori_pasien')->nullable();
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
        Schema::dropIfExists('antrian_fo');
    }
}
