<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKamarPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kamar_pasien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rawat_inap_id');
            $table->unsignedBigInteger('ruangan_id');
            $table->unsignedBigInteger('dokter_ruangan')->nullable();
            $table->unsignedBigInteger('dpjp')->nullable();
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->integer('durasi')->nullable();
            $table->bigInteger('tarif')->nullable();
            $table->string('resiko_jatuh_pasien')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inap')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('ruangan_id')->references('id')->on('ruangan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('dpjp')->references('id')->on('dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('dokter_ruangan')->references('id')->on('dokter')
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
        Schema::dropIfExists('kamar_pasien');
    }
}
