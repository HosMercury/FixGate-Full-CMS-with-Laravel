<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'type',
        'contact',
        'priority',
        'notes',
        'location_id',
        'creator',
        'key',
        'number'
    ];

    /**
     * Get created at timestamp of the order
     *
     * @param $date
     * @return string
     */
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    /**
     * Get updated at timestamp of the order
     *
     * @param $date
     * @return string
     */
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->toDayDateTimeString();
    }

    ///////////////////  Order Relationships ////////////////

    /**
     * Relationship between type and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\Type');
    }

    /**
     * Relationship between assignments and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function assignments()
    {
        return $this->hasMany('App\Assignment');
    }

    /**
     * Group by status
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function groupedAssignments()
    {
        return $this->hasMany(Assignment::class)->groupBy('status');
    }

    /**
     * Relationship between materials and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function materials()
    {
        return $this->belongsToMany('App\Material')->withPivot('quantity')->withTimestamps();
    }

    /**
     * Relationship between costs and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function costs()
    {
        return $this->hasMany('App\Cost');
    }

    /**
     * Relationship between ratings and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rating()
    {
        return $this->hasOne('App\Rating');
    }

    /**
     * Relationship between bills and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bills()
    {
        return $this->hasMany('App\Bill');
    }

    /**
     * Relationship between location and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    /**
     * Relationship between user and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the full url for this order
     *
     * @return string
     */
    public function path()
    {
        return 'orders/' . substr($this->number, 0, 4) . '/' . substr($this->number, 5);
    }
    
}
