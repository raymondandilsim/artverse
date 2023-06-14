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
        Schema::create('lukisans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nama_lukisan');
            $table->double('harga');
            $table->longText('deskripsi');
            $table->integer('stok');
            $table->string('kondisi');
            $table->string('berat');
            $table->string('ukuran');
            $table->string('gambar_pertama');
            $table->string('gambar_kedua')->nullable();
            $table->string('gambar_ketiga')->nullable();
            $table->integer('flag')->default(0);
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
        Schema::dropIfExists('lukisans');
    }
};
