<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriggerSupply extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('CREATE TRIGGER tg_pasok_barang AFTER INSERT ON detail_supplies FOR EACH ROW
            IF NEW.status > 0
                THEN
                    UPDATE products SET stok = stok + NEW.jumlah WHERE kode_barang = NEW.kode_barang;
            END IF
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER tg_pasok_barang');
    }
}
