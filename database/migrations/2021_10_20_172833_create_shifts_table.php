<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id')->nullable();
            $table->bigInteger('start_cash')->default(0);
            $table->bigInteger('difference')->default(0);
            $table->bigInteger('expected')->default(0);
            $table->bigInteger('sold')->default(0);
            $table->bigInteger('actual')->default(0);
            $table->bigInteger('cash')->default(0);
            $table->bigInteger('transfer')->default(0);
            $table->bigInteger('qris')->default(0);
            $table->bigInteger('ovo')->default(0);
            $table->bigInteger('gopay')->default(0);
            $table->bigInteger('invoice')->default(0);
            $table->dateTime('mulai')->nullable();
            $table->dateTime('selesai')->nullable();
            $table->timestamps();

            $table->foreign('users_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shifts');
    }
}
