<?php

use Carbon\Carbon;
use \Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    protected $toTruncate = [];

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

        factory('App\Location',5)->create();

        factory(App\Order::class, 10)->create()->each(function($o) {
            $o->workers()->save(factory(App\Worker::class)->make());
            $o->assignments()->save(factory(App\Assignment::class)->make());
            $o->materials()->save(factory(App\Material::class)->make());
        });

        Model::reguard();
    }
}
