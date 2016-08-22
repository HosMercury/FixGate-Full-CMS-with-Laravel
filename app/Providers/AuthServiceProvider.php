<?php

namespace App\Providers;

use App\Permission;
use App\Order;
use App\Policies\OrderPolicy;
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
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        // public function show_order(User $user, Order $order){
        //      return  $user->id === $order->user_id;//true
        // }

        $this->registerPolicies($gate);

        // $gate->define('show_order',function(){
        //      return $user->hasRole(show_order->admin) ;//true
        // });


//        foreach ($this->getPermissions() as $permission) {
//
//            $gate->define($permission->name, function ($user) use ($permission) {
//                 return $user->hasRole($permission->roles);
//            });
//
//        }
//
//    }
//
//    protected function getPermissions()
//    {
//        try {
//            return Permission::with('roles')->get();
//        } catch (\Exception $e) {
//            return [];
//        }
    }
}
