<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplies', function (Blueprint $table) {
            $table->id();
            $table->string('nota')->nullable();
<<<<<<< HEAD
            $table->unsignedBigInteger('suppliers_id');
=======
            $table->string('suppliers_id');
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
            $table->string('status');
            $table->integer('id_pemasok');
            $table->date('date')->nullable();
            $table->timestamps();
<<<<<<< HEAD

            $table->foreign('suppliers_id')->references('id')->on('suppliers');
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
        Schema::dropIfExists('supplies');
    }
}
