<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'store_code','name',  'address',
        'creator','latitude', 'longitude', 'city'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function owns(Order $order)
    {
    }

}
