<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosaPasienRajalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosa_pasien_rajal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_dokter_id');
            $table->unsignedBigInteger('diagnosa_id');
            $table->longText('bagian')->nullable();
            $table->timestamps();

            $table->foreign('periksa_dokter_id')->references('id')->on('periksa_dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('diagnosa_id')->references('id')->on('diagnosa')
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
        Schema::dropIfExists('diagnosa_pasien_rajal');
    }
}
