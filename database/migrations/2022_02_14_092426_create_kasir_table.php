<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasirTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kasir', function (Blueprint $table) {
            $table->id();
            $table->string('kode')->unique()->nullable();
            $table->unsignedBigInteger('pemeriksaan_id');
            $table->unsignedBigInteger('admin')->nullable();
            $table->bigInteger('deposit_awal')->default(0)->nullable();
            $table->dateTime('tanggal_pembayaran')->nullable();
            $table->dateTime('tanggal_deposit')->nullable();
            $table->bigInteger('total_tagihan')->nullable();
            $table->bigInteger('diskon')->default(0)->nullable();
            $table->bigInteger('pajak')->default(0)->nullable();
            $table->bigInteger('dibayar')->default(0)->nullable();
            $table->bigInteger('sisa')->default(0)->nullable();
            $table->string('metode_pembayaran')->nullable();
            $table->bigInteger('sisa_deposit')->nullable();
            $table->string('status')->nullable()->default('belum dilayanani');
            $table->string('status_pembayaran')->nullable()->default('belum dibayar');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaan')
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
        Schema::dropIfExists('kasir');
    }
}
