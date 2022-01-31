<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObatPasienPeriksaRajal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obat_pasien_periksa_rajal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('periksa_dokter_id');
            $table->unsignedBigInteger('obat_apotek_id');
            $table->string('komposisi')->nullable();
            $table->string('signa')->nullable();
            $table->bigInteger('jumlah')->default(1);
<<<<<<< HEAD
<<<<<<< HEAD
            $table->bigInteger('harga_obat');
            $table->bigInteger('subtotal')->default(0);
=======
            $table->decimal('harga_obat');
            $table->decimal('subtotal')->default(0);
>>>>>>> 3703707 (malam jum'at 00:45)
=======
            $table->decimal('harga_obat');
            $table->decimal('subtotal')->default(0);
>>>>>>> 3703707 (malam jum'at 00:45)
            $table->timestamps();

            $table->foreign('periksa_dokter_id')->references('id')->on('periksa_dokter')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('obat_apotek_id')->references('id')->on('obat_apotek')
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
        Schema::dropIfExists('obat_pasien_periksa_rajal');
    }
}
