<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'harga', 'jumlah', 'jenis_diskon_per_barang', 'diskon_per_barang', 'jenisPayment_id'
    ];

    protected $appends = [
        'total_barang_string',
        'nama_singkatan'
    ];
    
    public function jenisPayment()
    {
        return $this->belongsTo(jenis_payment::class, 'jenisPayment_id', 'id');
    }

    public function getTotalBarangStringAttribute()
    {
        $nominal = $this->total_barang;
        return ($nominal<0 ? '(' : '').'Rp '.number_format(($nominal<0 ? $nominal*-1 : $nominal), 0, ',', '.').($nominal<0 ? ')' : '');
    }

    public function getNamaSingkatanAttribute()
    {
        $nama = strtoupper(substr($this->nama_barang,0, 2));
        return $nama;
    }
}
