<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Payments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            'name' => "Cash",
        ]);

        DB::table('payments')->insert([
            'name' => "Transfer",
        ]);

        DB::table('payments')->insert([
            'name' => "Qris",
        ]);

        DB::table('payments')->insert([
            'name' => "Ovo",
        ]);

        DB::table('payments')->insert([
            'name' => "Gopay",
        ]);

        DB::table('payments')->insert([
            'name' => "Hutang",
        ]);
    }
}
