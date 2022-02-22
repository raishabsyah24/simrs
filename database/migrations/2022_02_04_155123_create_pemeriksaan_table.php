<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique();
            $table->string('no_sep')->unique()->nullable();
            $table->string('no_bpjs')->nullable();
            $table->string('no_rekam_medis')->nullable();
            $table->unsignedBigInteger('faskes_id')->nullable();
            $table->unsignedBigInteger('pasien_id');
            $table->unsignedBigInteger('kategori_pasien');
            $table->date('tanggal');
            $table->string('status')->default('belum selesai');
            $table->string('pasien_sudah_membaca_dan_setuju_dengan_peraturan')->nullable();
            $table->timestamps();

            $table->foreign('faskes_id')->references('id')->on('faskes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('pemeriksaan');
    }
}
