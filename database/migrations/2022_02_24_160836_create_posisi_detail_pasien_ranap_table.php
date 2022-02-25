<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosisiDetailPasienRanapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posisi_detail_pasien_ranap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('posisi_pasien_ranap_id');
            $table->string('aktifitas')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('waktu')->nullable();
            $table->string('status')->default('proses')->nullable();

            $table->foreign('posisi_pasien_ranap_id')->references('id')->on('posisi_pasien_ranap')
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
        Schema::dropIfExists('posisi_detail_pasien_ranap');
    }
}
