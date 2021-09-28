<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Initialize
    protected $fillable = [
        'kode_barang', 'jenis_barang', 'nama_barang', 'berat_barang', 'merek', 'stok', 'limit', 'harga', 'keterangan','laba_rupiah','laba_persen'
    ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}