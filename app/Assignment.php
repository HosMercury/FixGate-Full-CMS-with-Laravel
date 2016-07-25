<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignment extends Model
{
    protected $fillable = ['order_id', 'status','reason'];

    public $timestamps = ['creates_at', 'updated_at', 'deleted_at'];

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
        return $this->belongsTo('App\Order')->withPivot('reason')->withTimestamps();
    }
}
