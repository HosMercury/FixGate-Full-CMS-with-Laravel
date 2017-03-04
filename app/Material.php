<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
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

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withTimestamps();
    }
}
