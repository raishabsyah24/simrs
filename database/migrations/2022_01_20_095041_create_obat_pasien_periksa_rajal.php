<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatPasienPeriksaRajal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_pasien_periksa_rajal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_dokter_id');
            $table->unsignedBigInteger('obat_apotek_id');
            $table->string('signa')->nullable();
            $table->decimal('harga_obat');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('periksa_dokter_id')->references('id')->on('periksa_dokter')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('obat_apotek_id')->references('id')->on('obat_apotek')
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
        Schema::dropIfExists('obat_pasien_periksa_rajal');
    }
}