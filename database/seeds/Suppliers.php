<?php

use Illuminate\Database\Seeder;

class Suppliers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("suppliers")->insert([
            "nama" => "john doe",
            "asal" => "Indonesia",
            "perusahaan" => "IndoGrosir",
            "alamat" => "Sidoarjo",
            "telepon" => "12356789",
            "email" => "john@gmail.com"
        ]);

        DB::table("suppliers")->insert([
            "nama" => "doe john",
            "asal" => "Indonesia",
            "perusahaan" => "Indomaret",
            "alamat" => "Sidoarjo",
            "telepon" => "12356789",
            "email" => "doe@gmail.com"
        ]);

        DB::table("suppliers")->insert([
            "nama" => "budi",
            "asal" => "Indonesia",
            "perusahaan" => "Alfamaret",
            "alamat" => "Sidoarjo",
            "telepon" => "12356789",
            "email" => "budi@gmail.com"
        ]);
    }
}
