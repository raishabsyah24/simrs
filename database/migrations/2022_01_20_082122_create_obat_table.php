<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kategori_obat')->nullable();
            $table->string('kode')->unique();
            $table->string('nama_paten');
            $table->string('nama_generik');
            $table->text('komposisi')->nullable();
            $table->string('status')->default('aktif');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('kategori_obat')->references('id')->on('kategori_obat')
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
        Schema::dropIfExists('obat');
    }
}
