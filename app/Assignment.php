<?php

namespace App;

use Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Assignment
 * @package App
 */
class Assignment extends Model
{

    /**
     * @var bool
     */
    public $timestamps = true;


    /**
     * @var array
     */
    protected $fillable = ['order_id', 'status','worker','vendor','creator','created_at','updated_at' ,'done'];


    /**
     * @param $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    /**
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    /**
     * Relationship between orders and assignments
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo('App\Order')
            ->withTimestamps();
    }
}
