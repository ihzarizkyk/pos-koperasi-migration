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
<<<<<<< HEAD
            $table->unsignedBigInteger('category_id')->nullable();
=======
            $table->string('category_id')->nullable();
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
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
<<<<<<< HEAD

            $table->foreign('category_id')->references('id')->on('categories');
=======
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
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
