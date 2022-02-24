<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurse_station', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->string('lokasi');
            $table->unsignedBigInteger('dokter_ruangan')->nullable();
            $table->unsignedBigInteger('dpjp')->nullable();
            $table->timestamps();

            $table->foreign('dokter_ruangan')->references('id')->on('dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('dpjp')->references('id')->on('dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nurse_station');
    }
}
