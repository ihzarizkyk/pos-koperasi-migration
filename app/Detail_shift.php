<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail_shift extends Model
{
    public function jenis_payments()
    {
        return $this->belongsTo(jenis_payment::class, 'jenis_payments_id');
    }
}
