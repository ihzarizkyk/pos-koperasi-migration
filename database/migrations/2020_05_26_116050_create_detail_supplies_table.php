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
            $table->unsignedBigInteger('supplies_id')->nullable();
            $table->string('kode_barang');
            $table->string('nama_barang')->nullable();
            $table->string('jumlah')->nullable();
            $table->string('harga_beli')->nullable();
            $table->string('tempat_beli')->nullable();
            $table->string('subtotal')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            // $table->foreign('supplies_id')->references('id')->on('suppliers');
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
