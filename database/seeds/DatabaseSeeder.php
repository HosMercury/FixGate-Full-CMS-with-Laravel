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
        factory('App\Order',50)->create();
        factory('App\Worker',50)->create();

        factory(App\Order::class, 50)->create()->each(function($o) {
            $o->workers()->save(factory(App\Worker::class)->make());
            $o->assignments()->save(factory(App\Assignment::class)->make());
        });

        Model::reguard();
    }
}
