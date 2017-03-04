<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'id','name', 'manager', 'address',
        'user_id','latitude', 'longitude', 'city'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function owns(Order $order)
    {
    }

}
