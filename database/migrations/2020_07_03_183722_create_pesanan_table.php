<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesananTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsumen_id')->references('id')->on('konsumen');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('meja_id')->references('id')->on('meja');
            $table->string('kode');
            $table->integer('total_harga');
            $table->integer('diskon');
            $table->integer('ppn');
            $table->integer('grand_total');
            $table->string('status');
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
        Schema::dropIfExists('pesanan');
    }
}
