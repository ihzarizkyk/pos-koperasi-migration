<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $table = "adjustments";

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
