<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = ['order_id','description','cost'];
    public function orders()
    {
        return $this->belongsTo('App\Order');
    }

}
