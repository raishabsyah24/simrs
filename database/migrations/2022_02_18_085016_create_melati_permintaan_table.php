<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMelatiPermintaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('melati_permintaan', function (Blueprint $table) {
            $table->id();
            $table->string('no_permintaan');
            $table->string('nama_unit');
            $table->dateTime('tanggal_permintaan');
            $table->string('jenis_permintaan');
            $table->string('item_permintaan');
            $table->bigInteger('jumlah');
            $table->bigInteger('stok_lama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('melati_permintaan');
    }
}
