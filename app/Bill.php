<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['order_id','name','thumbnail'];
    public function orders()
    {
        return $this->belongsTo('App\Order');
    }
}
