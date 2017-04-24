<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Type
 * @package App
 */
class Type extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
      'name','description','creator'
    ];
}
