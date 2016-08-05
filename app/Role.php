<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role','role_location'];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
