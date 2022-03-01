<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitDokterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visit_dokter', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rawat_inap_id');
            $table->unsignedBigInteger('dokter_id');
            $table->dateTime('tanggal_periksa');
            $table->bigInteger('tarif');
            $table->longText('keluhan')->nullable();
            $table->longText('subjektif')->nullable();
            $table->longText('objektif')->nullable();
            $table->longText('assesment')->nullable();
            $table->longText('plan')->nullable();
            $table->longText('informasi_tambahan')->nullable();
            $table->string('status_diperiksa');
            $table->timestamps();

            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inap')
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
        Schema::dropIfExists('visit_dokter');
    }
}
