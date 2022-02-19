<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('po', function (Blueprint $table) {
            $table->id();
            $table->string('no_po')->nullable();
            $table->string('tanggal_po')->nullable();
            $table->string('nama_po')->nullable();
            $table->string('perusahaan_tujuan')->nullable();
            $table->string('pembuat_po')->nullable();
            $table->bigInteger('kode_barang')->nullable();
            $table->bigInteger('jumlah_barang')->nullable();
            $table->string('keterangan')->nullable();
            $table->dateTime('tanggal_diterima')->nullable();
            $table->string('penerimaan_po')->nullable();
            $table->string('disetujui')->nullable();
            $table->string('status_po')->nullable();
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
        Schema::dropIfExists('po');
    }
}
