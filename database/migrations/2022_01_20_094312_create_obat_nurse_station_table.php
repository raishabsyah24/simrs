<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatNurseStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_nurse_station', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obat_id');
            $table->unsignedBigInteger('nurse_station_id');
            $table->bigInteger('harga_jual')->default(0);
            $table->bigInteger('stok')->default(0);
            $table->bigInteger('minimal_stok')->default(0);
            $table->bigInteger('maksimal_stok')->default(0);
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->date('ed')->nullable();
            $table->timestamps();

            $table->foreign('obat_id')->references('id')->on('obat')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('satuan_id')->references('id')->on('satuan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('nurse_station_id')->references('id')->on('nurse_station')
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
        Schema::dropIfExists('obat_nurse_station');
    }
}
