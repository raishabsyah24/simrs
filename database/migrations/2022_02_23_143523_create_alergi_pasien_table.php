<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlergiPasienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alergi_pasien', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pemeriksaan_id')->nullable();
            $table->unsignedBigInteger('rawat_inap_id')->nullable();
            $table->string('alergi')->nullable();
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
        Schema::dropIfExists('alergi_pasien');
    }
}
