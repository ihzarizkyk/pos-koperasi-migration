<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'harga', 'jumlah', 'diskon_per_barang'
    ];
}
