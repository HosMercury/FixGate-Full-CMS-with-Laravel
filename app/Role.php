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

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }

    public function hasPermission($permission_id)
    {
        $result = [];
        foreach ($this->permissions as $permission) {
            $result[] = $permission->id == intval($permission_id);
        }
        return in_array(false, $result);
    }
}