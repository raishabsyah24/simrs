<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosaTindakanPasienRanapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosa_tindakan_pasien_ranap', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('visit_dokter_id');
            $table->longText('diagnosa')->nullable();
            $table->longText('tindakan')->nullable();
            $table->longText('bagian')->nullable();
            $table->timestamps();

            $table->foreign('visit_dokter_id')->references('id')->on('visit_dokter')
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
        Schema::dropIfExists('diagnosa_tindakan_pasien_ranap');
    }
}
