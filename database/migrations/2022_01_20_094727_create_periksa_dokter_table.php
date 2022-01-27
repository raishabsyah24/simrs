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
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('poli_id');
            $table->string('no_antrian_periksa')->nullable();
            $table->string('no_antrian_apotek')->nullable();
            $table->date('tanggal');
            $table->longText('keluhan')->nullable();
            $table->longText('subjektif')->nullable();
            $table->longText('objektif')->nullable();
            $table->longText('assesment')->nullable();
            $table->longText('plan')->nullable();
            $table->longText('keterangan')->nullable();
            $table->string('status_diperiksa')->default('belum diperiksa');
            $table->string('status_lanjutan')->nullable();
            $table->string('alasan_dirujuk')->nullable();
            $table->date('jadwal_kontrol')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pemeriksaan_detail_id')->references('id')->on('pemeriksaan_detail')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('pasien_id')->references('id')->on('pasien')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('poli_id')->references('id')->on('poli')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
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
