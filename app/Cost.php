<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Cost
 * @package App
 */
class Cost extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['order_id','description','cost','user_id'];

    /**
     * Relationship between costs of bills  and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function orders()
    {
        return $this->belongsTo('App\Order');
    }

}
