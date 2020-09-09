<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['id', 'car_id', 'user_id', 'hours','status','charge'];
}
