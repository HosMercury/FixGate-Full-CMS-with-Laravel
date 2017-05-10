<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Grant privilege to super admins
     *
     * @return bool
     */
    public function sAdmin()
    {
        return auth()->user()->isSuperAdmin();
    }

    /**
     * Grant privilege to all admins
     * admins and super admins
     *
     * @return bool
     */
    public function admins()
    {
        return auth()->user()->fromAdmins();
    }
}
