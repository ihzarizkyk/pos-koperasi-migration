<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('products_id');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->bigInteger('hpp')->default(0);
            $table->bigInteger('harga');
            $table->integer('jumlah');
            $table->bigInteger('total_barang');
            $table->string('jenis_diskon_per_barang');
            $table->integer('diskon_per_barang');
            $table->bigInteger('laba');
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
        Schema::dropIfExists('transaction_details');
    }
}
