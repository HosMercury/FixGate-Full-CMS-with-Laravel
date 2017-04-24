<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Rating
 * @package App
 */
class Rating extends Model
{
    /**
     * @var array
     */
    protected $dates = ['created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $fillable = [
        'id', 'order_id' ,'rating','feedback','creator'
    ];

    /**
     * Relationship between rating and order
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order');
    }
}
