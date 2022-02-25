<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirRawatInapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasir_rawat_inap', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->nullable()->unique();
            $table->unsignedBigInteger('admin')->nullable();
            $table->unsignedBigInteger('rawat_inap_id')->nullable();
            $table->bigInteger('deposit_awal')->nullable();
            $table->dateTime('tanggal_deposit')->nullable();
            $table->bigInteger('sisa_deposit')->nullable();
            $table->bigInteger('tagihan')->nullable();
            $table->integer('pajak')->nullable();
            $table->integer('diskon')->nullable();
            $table->bigInteger('dibayar')->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->timestamps();

            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inap')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('admin')->references('id')->on('users')
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
        Schema::dropIfExists('kasir_rawat_inap');
    }
}
