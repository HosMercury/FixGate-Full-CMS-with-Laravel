<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    /**
     * Grant the request to all admins only
     *
     * @param $user
     * @return bool
     */
    public function before($user)
    {
        return !! $user->fromTitles();
    }
}