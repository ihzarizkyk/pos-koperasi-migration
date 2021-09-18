<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->unsignedBigInteger('id_user');
=======
            $table->integer('id_user');
>>>>>>> 8b89de85d390654f3b223af49246284a8672e46b
            $table->string('user');
            $table->string('nama_kegiatan');
            $table->integer('jumlah');
            $table->timestamps();
<<<<<<< HEAD

            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('activities');
    }
}
