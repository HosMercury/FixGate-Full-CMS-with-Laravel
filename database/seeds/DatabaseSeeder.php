<?php

use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = ['users' ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Model::unguard();

        foreach ($this->toTruncate as $table)
        {
            \DB::table($table)->truncate();
        }

        factory('App\User',50)->create();
        factory('App\Material',50)->create();
        factory('App\Location',50)->create();
        factory('App\Order',50)->create();
        factory('App\Worker',50)->create();
        factory('App\Role',10)->create();

        factory(App\Order::class, 50)->create()->each(function($o) {
            $o->workers()->save(factory(App\Worker::class)->make());
            $o->assignments()->save(factory(App\Assignment::class)->make());
            $o->materials()->save(factory(App\Material::class)->make());
        });

        factory(App\User::class, 50)->create()->each(function($o) {
            $o->role()->save(factory(App\Role::class)->make());
            $o->orders()->save(factory(App\Order::class)->make());
        });

        Model::reguard();
    }
}
