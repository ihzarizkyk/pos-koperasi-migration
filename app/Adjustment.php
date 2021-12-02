<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\AdjustmentDetail;

class Adjustment extends Model
{
    protected $table = "adjustments";
    protected $casts = [
        'item' => 'integer',
        'nominalInteger' => 'integer',
        'total' => 'integer'
    ];
    protected $appends = [
        'item',
        // 'nominal',
        // 'nominal_integer',
        // 'totalInteger'
    ];

    public function adjustment_details()
    {
        return $this->hasMany(AdjustmentDetail::class, 'adjustment_id', 'id_adjustment');
    }

    public function getItemAttribute()
    {
        return $this->adjustment_details->count();
    }

    // private function getNominal($id_adjustment){
    //     $nominal = AdjustmentDetail::select(DB::raw('sum((adjustment_details.actual_stock-adjustment_details.in_stock)*products.hpp) as nominal'))
    //     ->where('adjustment_id', $id_adjustment)
    //     ->join('products', 'adjustment_details.kode_barang', '=', 'products.kode_barang')->first()->nominal;
    //     return $nominal;
    // }

    public function getNominalIntegerAttribute()
    {
        $nominal = $this->adjustment_details->sum('nominal_integer');
        return $nominal;
    }

    public function getNominalAttribute()
    {
        $nominal = $this->adjustment_details->sum('nominal_integer');
        return ($nominal<0 ? '(' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal)).($nominal<0 ? ')' : '');
    }

    public function scopeLastIdAdjustment($query){
        return $query->select(DB::raw('max(TRIM(substring(id_adjustment, 5, 3))) as id_adjustment'))
        ->whereMonth('created_at', date('m'))
        ->first();
    }

    public function scopeTotalNominal($query){
        return $query->select(DB::raw('sum((adjustment_details.actual_stock-adjustment_details.in_stock)*adjustment_details.hpp) as totalInteger'))
        ->join('adjustment_details', 'adjustment_details.adjustment_id', '=', 'adjustments.id_adjustment');
    }

    public function getTotalAttribute()
    {
        $nominal = $this->totalInteger;
        return ($nominal<0 ? '(' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal)).($nominal<0 ? ')' : '');
    }
}
