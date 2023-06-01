<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaksi_id');
            $table->foreign('transaksi_id')->references('id')->on('transaksis');
            $table->unsignedBigInteger('lukisan_id');
            $table->foreign('lukisan_id')->references('id')->on('lukisans');
            $table->integer('kuantitas');
            $table->string('jasa_pengiriman')->default('JNE');
            $table->double('subtotal_produk');
            $table->double('subtotal_pengiriman');
            $table->double('subtotal_asuransi');
            $table->double('harga_total');
            $table->string('alamat_asal');
            $table->string('alamat_destinasi');
            $table->string('catatan')->nullable();
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
        Schema::dropIfExists('detail_transaksis');
    }
};
