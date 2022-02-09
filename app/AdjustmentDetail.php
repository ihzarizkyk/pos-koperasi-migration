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
        return $this->hasOne(Product::class, 'id', 'products_id');
    }

    public function getStockDifferenceAttribute(){
        return $this->actual_stock - $this->in_stock;
    }

    public function getNominalIntegerAttribute(){
        $nominal = $this->stock_difference * $this->hpp;
        return $nominal;
        // return ($nominal<0 ? '-' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal));
    }

    public function getNominalAttribute(){
        $nominal = $this->append('nominal_integer')->nominal_integer;
        return ($nominal<0 ? '(' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal)).($nominal<0 ? ')' : '');
    }
}
