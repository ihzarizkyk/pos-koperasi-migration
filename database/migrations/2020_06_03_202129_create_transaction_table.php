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
            $table->unsignedBigInteger('customers_id');
            $table->unsignedBigInteger('shifts_id');
            $table->string('kode_transaksi');
            $table->bigInteger('subtotal');
            $table->string('jenis_diskon');
            $table->integer('diskon');
            $table->bigInteger('total');
            $table->bigInteger('bayar');
            $table->bigInteger('kembali');
            $table->string('kasir');
            $table->boolean('is_refund')->default(0);
            $table->string('alasan_refund')->nullable();
            
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
        Schema::dropIfExists('transactions');
    }
}
