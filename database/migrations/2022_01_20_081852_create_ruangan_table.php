<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRuanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ruangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nurse_station_id')->nullable();
            $table->string('kode_kamar');
            $table->string('kode_bed');
            $table->string('kelas');
            $table->bigInteger('tarif');
            $table->text('fasilitas')->nullable();
            $table->string('status_bed')->default('tersedia');
            $table->timestamps();

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
        Schema::dropIfExists('ruangan');
    }
}
