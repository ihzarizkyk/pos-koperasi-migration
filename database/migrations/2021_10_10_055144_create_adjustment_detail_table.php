<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustment_details', function (Blueprint $table) {
            $table->id();
            $table->string('adjustment_id')->nullable()->default(null);
            $table->string('products_id')->nullable()->default(null);
            $table->string('kode_barang');
            $table->bigInteger('hpp')->default(0);
            $table->integer('in_stock')->nullable();
            $table->integer('actual_stock')->nullable();
            $table->string('note')->nullable()->default(null);
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
        Schema::dropIfExists('adjustment_details');
    }
}
