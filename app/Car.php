<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand', 'name', 'price', 'seats', 'status', 'location', 'plate'];
    public $timestamps = false;
}
