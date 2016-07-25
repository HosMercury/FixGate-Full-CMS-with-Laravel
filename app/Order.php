<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = ['description','trade','contact','priority','notes','entry','exit'];

    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function materials()
    {
        return $this->belongsToMany('App\Material')->withPivot('quantity')->withTimestamps();
    }

    public function costs()
    {
        return $this->hasMany('App\Cost');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    public function workers()
    {
        return $this->belongsToMany('App\Worker')->withTimestamps();
    }

}
