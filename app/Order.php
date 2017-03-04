<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    protected $fillable = [
        'title',
        'description',
        'type',
        'contact',
        'priority',
        'notes',
        'location_id',
        'user_id',
        'key',
        'number'
    ];

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    ////////////////////  Relationships //////////////////

    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    public function groupedAssignments()
    {
        return $this->hasMany(Assignment::class)->groupBy('status');
    }

    public function materials()
    {
        return $this->belongsToMany('App\Material')->withPivot('quantity')->withTimestamps();
    }

    public function costs()
    {
        return $this->hasMany('App\Cost');
    }

    public function rating()
    {
        return $this->hasOne('App\Rating');
    }

    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

//    public function workers()
//    {
//        return $this->belongsToMany('App\Worker')->withPivot(['assignment'])->withTimestamps();
//    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function viewers()
    {

    }
}
