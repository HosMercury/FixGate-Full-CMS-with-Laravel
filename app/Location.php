<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
      'order_id','location_id'
    ];

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function location()
    {
        return $this->belongsToMany('App\Order');
    }

}
