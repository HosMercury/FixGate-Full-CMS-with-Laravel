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

//        factory(App\Location::class,5)->create();
//        factory(App\User::class,5)->create();

        factory(App\Order::class, 50)->create();
        Model::reguard();
    }
}
