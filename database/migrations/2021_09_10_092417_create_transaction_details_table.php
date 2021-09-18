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
<<<<<<< HEAD
            $table->unsignedBigInteger('transaction_id');
=======
            $table->bigInteger('transaction_id');
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->bigInteger('harga');
            $table->integer('jumlah');
            $table->bigInteger('total_barang');
            $table->integer('diskon_per_barang');
            $table->timestamps();
<<<<<<< HEAD

            $table->foreign('transaction_id')->references('id')->on('transactions');
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
        Schema::dropIfExists('transaction_details');
    }
}
