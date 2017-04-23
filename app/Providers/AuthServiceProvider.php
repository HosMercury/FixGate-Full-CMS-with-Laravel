<?php

namespace App\Providers;

use App\Order;
use App\Material;
use App\Location;
use App\Type;
use App\Policies\OrderPolicy;
use App\Policies\TypePolicy;
use App\Policies\MaterialPolicy;
use App\Policies\LocationPolicy;
use App\Policies\UserPolicy;
use App\User;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Order::class => OrderPolicy::class,
        Type::class => TypePolicy::class,
        Material::class => MaterialPolicy::class,
        Location::class => LocationPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);
    }

}