<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class MaterialPolicy
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
