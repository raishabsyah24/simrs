<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('no_sep')->unique()->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_asuransi')->nullable();
            $table->string('no_rekam_medis')->nullable();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('kategori_pasien');
            $table->string('posisi_pasien')->nullable();
            $table->date('tanggal')->nullable();
            $table->dateTime('checkin')->nullable();
            $table->dateTime('checkout')->nullable();
            $table->string('status')->default('belum selesai');
            $table->timestamps();

            $table->foreign('pasien_id')->references('id')->on('pasien')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('kategori_pasien')->references('id')->on('kategori_pasien')
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
        Schema::dropIfExists('rawat_inap');
    }
}
