<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable =[
        'type','title','SOH','description','size','price',
        'store','substore','manufacturere','barcode'
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
