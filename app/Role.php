<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'label', 'creator'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('name');
    }
}