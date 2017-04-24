<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Location
 * @package App
 */
class Location extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'store_code','name',  'address',
        'creator','latitude', 'longitude', 'city'
    ];

    /**
     * Relationship between locations and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

}
