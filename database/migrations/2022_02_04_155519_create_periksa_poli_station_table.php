<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaPoliStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_poli_station', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_detail_id');
            $table->unsignedBigInteger('pasien_id');
            $table->date('tanggal');
            $table->string('tb')->nullable();
            $table->string('bb')->nullable();
            $table->string('td')->nullable();
            $table->string('su')->nullable();
            $table->string('bmi')->nullable();
            $table->string('status_diperiksa')->default('belum diperiksa');
            $table->timestamps();

            $table->foreign('pemeriksaan_detail_id')->references('id')->on('pemeriksaan_detail')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('pasien_id')->references('id')->on('pasien')
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
        Schema::dropIfExists('periksa_poli_station');
    }
}
