<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Initialize
    protected $fillable = [
        'kode_barang', 'jenis_barang', 'nama_barang', 'berat_barang', 'merek', 'stok', 'limit', 'harga', 'keterangan','laba_rupiah','laba_persen'
    ];

    // protected $cast = [
    //     'hpp' => 'integer'
    // ];

    public function Category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function adjustment()
    {
        return $this->belongsTo(AdjustmentDetail::class,"kode_barang");
    }

    public function scopeProductSearch($query, $cari){
        return $this->where(function ($query) use ($cari){
            $query->where('kode_barang', 'like',"%".$cari."%")
            ->orWhere('nama_barang', 'like',"%".$cari."%")
            ->orWhere('merek', 'like', "%".$cari."%")
            ->orWhere('stok', 'like', "%".$cari."%");
        });
    }

    public function scopeStockChanging($query, $kode_barang){
        for($i=0; $i < count($kode_barang); $i++){
            $product_status = Product::where('kode_barang', '=', $kode_barang[$i])
            ->first();
            if($product_status->limit != null){
                if($product_status->stok == 0){
                    $product_status->keterangan = "Habis";
                    $product_status->save();
                }else if($product_status->stok < $product_status->limit){
                    $product_status->keterangan = "Hampir Habis";
                    $product_status->save();
                }else{
                    $product_status->keterangan = "Tersedia";
                    $product_status->save();
                }
            }
        }
    }
}