<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Material
 * @package App
 */
class Material extends Model
{
    /**
     * @var array
     */
    protected $fillable =[
        'type','name','description','width',
        'length','height','user_id','barcode',
        'location','sub_location','price','soh'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id','deleted_at','created_at','updated_at'];

    /**
     * Relationship between materials and orders
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany('App\Order')->withTimestamps();
    }
}
