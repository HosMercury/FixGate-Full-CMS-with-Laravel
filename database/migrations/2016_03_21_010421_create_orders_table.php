<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('title');
            $table->text('description');
            $table->string('trade');
            $table->string('contact');
            $table->enum('priority',['Regular-72h','Important-48h','Urgent-24h','Crisis-psh']);
            $table->text('notes')->nullable();
            $table->integer('location_id')->unsigned();
            $table->integer('user_id')->unsigned()->index();
            $table->timestamp('entry');
            $table->timestamp('exit');
            $table->integer('close_key')->unsigned();
            $table->softDeletes();
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
        Schema::drop('orders');
    }
}
