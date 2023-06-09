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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('penjual_id');
            $table->date('tanggal_pembelian');
            $table->string('status');
            $table->string('jasa_pengiriman')->default('JNE');
            $table->double('subtotal_pengiriman');
            $table->double('total_pembelian');
            $table->string('bukti_pembayaran')->default('');
            $table->string('bukti_pengiriman')->default('');
            $table->string('bukti_pelepasan_dana')->default('');
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
        Schema::dropIfExists('transaksis');
    }
};
