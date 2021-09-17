<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Initialize
    protected $fillable = [
        'kode_transaksi', 'total_barang', 'subtotal', 'jenis_diskon', 'diskon', 'total', 'bayar', 'kembali', 'id_kasir', 'kasir',
    ];
}
