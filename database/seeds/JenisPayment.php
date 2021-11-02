<?php

use Illuminate\Database\Seeder;

class JenisPayment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jenis_payments')->insert([
            'jenis' => "Cash",
        ]);

        DB::table('jenis_payments')->insert([
            'jenis' => "Transfer",
        ]);

        DB::table('jenis_payments')->insert([
            'jenis' => "Qris",
        ]);

        DB::table('jenis_payments')->insert([
            'jenis' => "Ovo",
        ]);

        DB::table('jenis_payments')->insert([
            'jenis' => "Gopay",
        ]);

        DB::table('jenis_payments')->insert([
            'jenis' => "Invoice",
        ]);
    }
}
