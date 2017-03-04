<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function show_order(User $user, Order $order)
    {

        return $user->can('show_orders')
//        && $order->isSeenBy($user)
            ;
    }

    public function show_order_details(User $user, Order $order)
    {
        return $order->viewedBy($user,'details');
    }

    public function show_order_assignments(User $user, Order $order)
    {
        return $order->viewedBy($user, 'assignments');
    }

    public function show_order_financial(User $user, Order $order)
    {
        return $order->viewedBy($user, 'costs');
    }
}
