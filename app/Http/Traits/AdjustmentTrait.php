<?php

namespace App\Http\Traits;
use App\Adjustment;
use App\AdjustmentDetail;
use App\Product;
use DB;

trait AdjustmentTrait {

    public function addAdjustment($kode_barang, $in_stock, $actual_stock, $note){
        DB::beginTransaction();
        try{
            $adjust = new Adjustment;
            $adjust->save();
            for($i=0; $i < count($kode_barang); $i++){
                if($in_stock[$i]==$actual_stock[$i]){
                    throw new \ErrorException('Error found');
                }
                $product = Product::where('kode_barang', $kode_barang[$i])->first();
                $adjust_detail = new AdjustmentDetail;
                $adjust_detail->adjustment_id = $adjust->id;
                $adjust_detail->products_id = $product->id;
                $adjust_detail->kode_barang = $kode_barang[$i];
                $adjust_detail->hpp = $product->hpp;
                $adjust_detail->in_stock = $in_stock[$i];
                $adjust_detail->actual_stock = $actual_stock[$i];
                $adjust_detail->note = $note[$i];
                $adjust_detail->save();
                $product->stok = $actual_stock[$i];
                $product->save();
            }
            Product::stockChanging($kode_barang);
            DB::commit();
            return true;
        }catch(Exception $exception){
            DB::rollback();
            return false;
        }
    }

}