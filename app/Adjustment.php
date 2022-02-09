<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\AdjustmentDetail;

use App\Http\Traits\ChangeRomawiTrait;

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
        'id_adjustment'
        // 'nominal',
        // 'nominal_integer',
        // 'totalInteger'
    ];

    public function adjustment_details()
    {
        return $this->hasMany(AdjustmentDetail::class, 'adjustment_id', 'id');
    }

    public function getIdAdjustmentAttribute()
    {
        $date = strtotime($this->created_at);
        $id_adjustment = "ADJ.".str_pad($this->id,3,'0', STR_PAD_LEFT)."/".date('d', $date)."/".ChangeRomawiTrait::use(date('m', $date))."/".date('Y', $date);
        return $id_adjustment;
    }

    public function getItemAttribute()
    {
        return $this->adjustment_details->count();
    }

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

    public function scopeTotalNominal($query){
        return $query->select(DB::raw('sum((adjustment_details.actual_stock-adjustment_details.in_stock)*adjustment_details.hpp) as totalInteger'))
        ->join('adjustment_details', 'adjustment_details.adjustment_id', '=', 'adjustments.id');
    }

    public function getTotalAttribute()
    {
        $nominal = $this->totalInteger;
        return ($nominal<0 ? '(' : '').'Rp. '.number_format(($nominal<0 ? $nominal*-1 : $nominal)).($nominal<0 ? ')' : '');
    }
}
