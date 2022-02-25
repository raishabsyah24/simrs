<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrolPasienRanapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrol_pasien_ranap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rawat_inap_id');
            $table->dateTime('waktu_kontrol')->nullable();
            $table->longText('catatan')->nullable();
            $table->timestamps();

            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inap')
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
        Schema::dropIfExists('kontrol_pasien_ranap');
    }
}
