<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'harga', 'jumlah', 'jenis_diskon_per_barang', 'diskon_per_barang', 'jenisPayment_id'
    ];
    
    public function jenisPayment()
    {
        return $this->belongsTo(jenis_payment::class, 'jenisPayment_id', 'id');
    }
}
