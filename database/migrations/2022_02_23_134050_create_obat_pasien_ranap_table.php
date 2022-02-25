<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatPasienRanapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_pasien_ranap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obat_nurse_station_id');
            $table->unsignedBigInteger('visit_dokter_id')->nullable();
            $table->string('signa1')->nullable();
            $table->string('signa2')->nullable();
            $table->integer('jumlah')->nullable();
            $table->bigInteger('harga')->nullable();
            $table->bigInteger('subtotal')->nullable();
            $table->dateTime('waktu_diberikan')->nullable();
            $table->string('status_diberikan')->default('belum diberikan');
            $table->timestamps();

            $table->foreign('visit_dokter_id')->references('id')->on('visit_dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('obat_nurse_station_id')->references('id')->on('obat_nurse_station')
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
        Schema::dropIfExists('obat_pasien_ranap');
    }
}
