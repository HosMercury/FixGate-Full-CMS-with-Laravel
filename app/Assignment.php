<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{

    public $timestamps = true;


    protected $fillable = ['order_id', 'status','worker','vendor','creator','created_at','updated_at' ,'done'];


    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    public function orders()
    {
        return $this->belongsTo('App\Order')
            ->withTimestamps();
    }
}
