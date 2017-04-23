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
        'employee_id', 'name', 'email', 'password', 'location_id'
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

    public function owns(Order $order)
    {
        return $this->employee_id == $order->creator;
    }

    public function fromAdmins()
    {
        return auth()->user()->hasRole('admin') or auth()->user()->hasRole('superadmin');
    }

    public function isSuperAdmin()
    {
        return auth()->user()->hasRole('superadmin');
    }

    public function isSupervisor()
    {
        return auth()->user()->hasRole('supervisor');
    }

    public function isAccountant()
    {
        return auth()->user()->hasRole('accountant');
    }

    public function fromAdminsAndSupervisors()
    {
        return $this->fromAdmins() || $this->isSupervisor();
    }

    public function fromTitles()
    {
        return auth()->user()->fromAdmins()
        || auth()->user()->isSupervisor()
        || auth()->user()->isAccountant();
    }
}