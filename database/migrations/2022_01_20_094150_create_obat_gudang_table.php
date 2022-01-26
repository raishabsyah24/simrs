<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatGudangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_gudang', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('obat_id');
            $table->decimal('harga_jual')->default(0);
            $table->decimal('harga_beli')->default(0);
            $table->bigInteger('stok')->default(0);
            $table->bigInteger('minimal_stok')->default(0);
            $table->bigInteger('maksimal_stok')->default(0);
            $table->unsignedBigInteger('satuan_id')->nullable();
            $table->date('ed')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('obat_id')->references('id')->on('obat')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('satuan_id')->references('id')->on('satuan')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('obat_gudang');
    }
}
