<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('nama_barang');
            $table->string('berat_barang')->nullable();
            $table->string('merek')->nullable();
            $table->integer('laba_rupiah')->default(0);
            $table->integer('laba_persen')->default(0);
            $table->integer('stok')->default(0);
            $table->bigInteger('harga')->default(0);
            $table->bigInteger('hpp')->default(0);
            $table->string('keterangan')->default('Tersedia');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
