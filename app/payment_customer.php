<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class payment_customer extends Model
{
   
    public function jenisPayment()
    {
        return $this->belongsTo(jenis_payment::class, 'jenis_payments_id');
    }
}
