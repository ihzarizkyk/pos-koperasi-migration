<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSuppliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_supplies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplies_id');
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->string('jumlah');
            $table->string('harga_beli');
            $table->string('tempat_beli');
            $table->string('subtotal');
            $table->string('status');
            $table->timestamps();

            $table->foreign('supplies_id')->references('id')->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_supplies');
    }
}
