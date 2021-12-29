<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    public function Market()
    {
        return $this->belongsTo(Market::class, 'markets_id');
    }

    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
