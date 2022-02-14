<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeriksaRadiologiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periksa_radiologi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_detail_id');
            $table->unsignedBigInteger('periksa_dokter_id')->nullable();
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->unsignedBigInteger('pasien_id');
            $table->date('tanggal');
            $table->longText('keterangan')->nullable();
            $table->string('status_diperiksa')->default('belum diperiksa');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('periksa_dokter_id')->references('id')->on('periksa_dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('pemeriksaan_detail_id')->references('id')->on('pemeriksaan_detail')
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
        Schema::dropIfExists('periksa_radiologi');
    }
}
