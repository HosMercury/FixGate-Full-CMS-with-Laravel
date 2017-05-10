<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('store_code')->unsigned()->unique();
            $table->integer('creator')->unsigned()->index();
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('city');
            $table->float('latitude','16','6')->nullable();
            $table->float('longitude','16','6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locations');
    }
}
