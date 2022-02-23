<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsuransiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asuransi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_id')->nullable();
            $table->unsignedBigInteger('rawat_inap_id')->nullable();
            $table->string('nama');
            $table->string('email')->nullable();
            $table->string('no_telpon')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->timestamps();


            $table->foreign('pemeriksaan_id')->references('id')->on('pemeriksaan')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('rawat_inap_id')->references('id')->on('rawat_inap')
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
        Schema::dropIfExists('asuransi');
    }
}
