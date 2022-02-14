<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_detail_id');
            $table->unsignedBigInteger('periksa_poli_station_id')->nullable();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('dokter_id');
            $table->string('no_antrian_periksa')->nullable();
            $table->string('no_antrian_apotek')->nullable();
            $table->dateTime('tanggal');
            $table->longText('diagnosa')->nullable();
            $table->longText('keluhan')->nullable();
            $table->longText('subjektif')->nullable();
            $table->longText('objektif')->nullable();
            $table->longText('assesment')->nullable();
            $table->longText('plan')->nullable();
            $table->longText('informasi_tambahan')->nullable();
            $table->string('status_diperiksa')->default('belum diperiksa');
            $table->string('status_lanjutan')->nullable();
            $table->string('alasan_dirujuk')->nullable();
            $table->date('jadwal_kontrol')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pemeriksaan_detail_id')->references('id')->on('pemeriksaan_detail')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('periksa_poli_station_id')->references('id')->on('periksa_poli_station')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('pasien_id')->references('id')->on('pasien')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('dokter_id')->references('id')->on('dokter')
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
        Schema::dropIfExists('periksa_dokter');
    }
}
