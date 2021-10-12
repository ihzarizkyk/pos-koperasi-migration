<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class AdjustmentDetail extends Model
{
    protected $appends = [
        'stock_difference'
    ];
    public function product()
    {
        return $this->hasOne(Product::class, 'kode_barang', 'kode_barang');
    }

    public function getStockDifferenceAttribute(){
        return $this->actual_stock - $this->in_stock;
    }

    public function getNominalIntegerAttribute(){
        $hpp = Product::where('kode_barang', $this->kode_barang)->first()->hpp;
        $nominal = $this->stock_difference * $hpp;
        return $nominal;
        // return ($nominal<0 ? '-' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal));
    }

    public function getNominalAttribute(){
        $nominal = $this->append('nominal_integer')->nominal_integer;
        return ($nominal<0 ? '-' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal));
    }
}
