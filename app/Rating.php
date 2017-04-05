<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'id', 'order_id' ,'rating','feedback','creator'
    ];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
