<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }


    /**
     * Does user this role?
     *
     * @param string $role
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }

        return !!$role->intersect($this->roles)->count();
    }

    /**
     * Assign the role to the user
     *
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function assignRole($role)
    {
        return $this->roles()->save(
            Role::whereName($role)->firstOrFail()
        );
    }

    /**
     * Does this user is the owner of this order?
     *
     * @param Order $order
     * @return bool
     */
    public function owns(Order $order)
    {
        return $this->employee_id == $order->creator;
    }

    /**
     * Does the user is admin or superadmin?
     *
     * @return bool
     */
    public function fromAdmins()
    {
        return auth()->user()->hasRole('admin') or auth()->user()->hasRole('superadmin');
    }

    /**
     * Does the user is superadmin?
     *
     * @return bool
     */
    public function isSuperAdmin()
    {
        return auth()->user()->hasRole('superadmin');
    }

    /**
     * Does the user is supervisor?
     *
     * @return bool
     */
    public function isSupervisor()
    {
        return auth()->user()->hasRole('supervisor');
    }

    /**
     * Does the user is accountant?
     *
     * @return bool
     */
    public function isAccountant()
    {
        return auth()->user()->hasRole('accountant');
    }

    /**
     * Does the user is admin or superadmin or supervisor?
     *
     * @return bool
     */
    public function fromAdminsAndSupervisors()
    {
        return $this->fromAdmins() || $this->isSupervisor();
    }

    /**
     * Does the user is admin or superadmin or supervisor or accountant?
     *
     * @return bool
     */
    public function fromTitles()
    {
        return auth()->user()->fromAdmins()
        || auth()->user()->isSupervisor()
        || auth()->user()->isAccountant();
    }
}