<?php

namespace App\Policies;

use App\Order;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function show_order_page(User $user, Order $order)
    {
        return $user->hasPermission() && $order->isSeenBy($user);
    }

    public function show_order_details(User $user, Order $order)
    {
        return $order->isSeenBy($user,'details');
    }

    public function show_order_assignments(User $user, Order $order)
    {
        return $order->isSeenBy($user, 'assignments');
    }

    public function show_order_costs(User $user, Order $order)
    {
        return $order->isSeenBy($user, 'costs');
    }
}
