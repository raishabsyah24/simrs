<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePemeriksaanDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemeriksaan_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_id');
            $table->unsignedBigInteger('poli_id');
            $table->unsignedBigInteger('layanan_id');
            $table->unsignedBigInteger('dokter_id')->nullable();
            $table->bigInteger('tagihan_layanan')->default(0);
            $table->string('status')->default('belum selesai');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('poli_id')->references('id')->on('poli')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('layanan_id')->references('id')->on('layanan')
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
        Schema::dropIfExists('pemeriksaan_detail');
    }
}
