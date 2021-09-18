<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->bigInteger('harga');
            $table->integer('jumlah');
            $table->bigInteger('total_barang');
            $table->bigInteger('subtotal');
            $table->integer('diskon');
            $table->bigInteger('total');
            $table->bigInteger('bayar');
            $table->bigInteger('kembali');
<<<<<<< HEAD
            $table->unsignedBigInteger('id_kasir');
            $table->string('kasir');
            $table->timestamps();

            $table->foreign('id_kasir')->references('id')->on('users');
=======
            $table->integer('id_kasir');
            $table->string('kasir');
            $table->timestamps();
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
        Schema::dropIfExists('transactions');
    }
}
