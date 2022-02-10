<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasir_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kasir_id');
            $table->string('jenis_tagihan');
            $table->bigInteger('subtotal');
            $table->dateTime('tanggal_layanan');
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
        Schema::dropIfExists('kasir_detail');
    }
}
