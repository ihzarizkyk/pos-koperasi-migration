<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
   
    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    
    public function shift()
    {
        return $this->hasOne(Shift::class);
    }
}
