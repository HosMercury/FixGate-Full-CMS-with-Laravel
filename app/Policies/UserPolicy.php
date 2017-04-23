<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function sAdmin()
    {
        return auth()->user()->isSuperAdmin();
    }

    public function admins()
    {
        return auth()->user()->fromAdmins();
    }
}
