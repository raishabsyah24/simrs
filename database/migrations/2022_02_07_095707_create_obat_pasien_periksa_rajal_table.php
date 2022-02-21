<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatPasienPeriksaRajalTable extends Migration
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
            $table->string('komposisi')->nullable();
            $table->string('signa1')->nullable();
            $table->string('signa2')->nullable();
            $table->bigInteger('jumlah')->default(1);
            $table->bigInteger('harga_obat');
            $table->bigInteger('subtotal')->default(0);
            $table->string('status')->nullable()->default('belum diterima');
            $table->timestamps();

            $table->foreign('periksa_dokter_id')->references('id')->on('periksa_dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('obat_apotek_id')->references('id')->on('obat_apotek')
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
        Schema::dropIfExists('obat_pasien_periksa_rajal');
    }
}
