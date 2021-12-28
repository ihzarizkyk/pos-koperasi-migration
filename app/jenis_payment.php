<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jenis_payment extends Model
{
    protected $fillable = [
        'jenis'
    ];
    
    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    public function detailShift()
    {
        return $this->hasOne(Detail_shift::class);
    }
}
