<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'id','name', 'manager', 'address', 'created_by', 'latitude', 'longitude', 'city'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function owns(Order $order)
    {
        return $order->location->manager_id;
    }

}
