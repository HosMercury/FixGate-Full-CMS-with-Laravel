<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Bill
 * @package App
 */
class Bill extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['order_id','name','thumbnail','user_id'];

    /**
     * Relationship between bills and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo('App\Order');
    }
}
