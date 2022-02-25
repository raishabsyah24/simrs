<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirRawatInapDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasir_rawat_inap_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kasir_rawat_inap_id');
            $table->string('jenis_tagihan');
            $table->bigInteger('subtotal')->nullable();
            $table->dateTime('tanggal_layanan')->nullable();
            $table->timestamps();

            $table->foreign('kasir_rawat_inap_id')->references('id')->on('kasir_rawat_inap')
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
        Schema::dropIfExists('kasir_rawat_inap_detail');
    }
}
