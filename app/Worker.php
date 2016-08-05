<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    protected $fillable = ['name','role','assignment','reason'];

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withTimestamps();
    }

}
