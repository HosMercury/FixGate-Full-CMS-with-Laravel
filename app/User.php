<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','manager_id','name', 'email', 'password', 'location_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    public function hasPermission()
    {
        foreach ($this->getPermissions() as $permission) {
            return $this->hasRole($permission->roles);
        }
    }

    protected function getPermissions()
    {
        try {
            return Permission::with('roles')->get();
        } catch (\Exception $e) {
            return [];
        }
    }

    public function owns(Order $order)
    {
        return $this->id === $order->creator;
    }

}
