<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenanggungJawabPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penanggung_jawab_pasien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_id');
            $table->string('nama');
            $table->string('nik')->nullable();
            $table->string('jenis_kelamin');
            $table->string('no_hp')->nullable();
            $table->string('hubungan_dengan_pasien')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();

            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaan')
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
        Schema::dropIfExists('penanggung_jawab_pasien');
    }
}
