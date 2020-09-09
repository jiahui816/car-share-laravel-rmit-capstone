<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function books()
    {
        return $this->hasMany('App\Booking');
    }
}
