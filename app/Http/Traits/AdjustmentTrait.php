<?php

namespace App\Http\Traits;
use App\Adjustment;
use App\AdjustmentDetail;
use App\Product;
use DB;

trait AdjustmentTrait {

    private function getRomawi($bln){
        switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
        }
    }

    public function addAdjustment($kode_barang, $in_stock, $actual_stock, $note){
        DB::beginTransaction();
        try{
            $last_adj = Adjustment::lastIdAdjustment()->id_adjustment;
            if($last_adj == null){
                $last_adj = 1;
            }else{
                $last_adj+=1;
            }
            $id_adjustment = "ADJ.".str_pad($last_adj,3,'0', STR_PAD_LEFT)."/".mt_rand(1000,9999)."/".$this->getRomawi(date('m'))."/".date('Y');
            $adjust = new Adjustment;
            $adjust->id_adjustment = $id_adjustment;
            $adjust->save();
            for($i=0; $i < count($kode_barang); $i++){
                if($in_stock[$i]==$actual_stock[$i]){
                    throw new \ErrorException('Error found');
                }
                $product = Product::where('kode_barang', $kode_barang[$i])->first();
                $adjust_detail = new AdjustmentDetail;
                $adjust_detail->adjustment_id = $id_adjustment;
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