<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class OrderPolicy
 * @package App\Policies
 */
class OrderPolicy
{
    use HandlesAuthorization;


    /**
     * Grant the request to all
     * (admins and supervisors and accountant)
     *
     * @return bool
     */
    public function titles()
    {
        return auth()->user()->fromTitles();
    }

}