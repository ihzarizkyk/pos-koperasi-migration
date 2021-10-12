<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToAdjustmentsOnly extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('adjustments', function (Blueprint $table) {
            $table->dropColumn('kode_barang');
            $table->dropColumn('nama_barang');
            $table->dropColumn('in_stock');
            $table->dropColumn('actual_stock');
            $table->dropColumn('adjustment');
            $table->string('id_adjustment')->after('id')->nullable()->default(null)->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adjustments', function (Blueprint $table) {
            $table->string('kode_barang')->after('id');
            $table->string('nama_barang')->after('kode_barang')->nullable();
            $table->integer('in_stock')->after('nama_barang')->nullable();
            $table->integer('actual_stock')->after('in_stock')->nullable();
            $table->integer('adjustment')->after('actual_stock')->nullable();
            $table->dropColumn('id_adjustment');
        });
    }
}
