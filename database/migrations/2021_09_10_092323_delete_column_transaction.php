<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteColumnTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transactions', function($table) {
            $table->dropColumn('kode_barang');
            $table->dropColumn('nama_barang');
            $table->dropColumn('harga');
            $table->dropColumn('jumlah');
            $table->dropColumn('total_barang');
         });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transactions', function($table) {
            $table->string('kode_barang');
            $table->string('nama_barang');
            $table->bigInteger('harga');
            $table->integer('jumlah');
            $table->bigInteger('total_barang');
         });
    }
}
