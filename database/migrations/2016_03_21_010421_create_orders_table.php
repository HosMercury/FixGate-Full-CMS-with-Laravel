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
            $table->increments('id')->unsigned(); // have not to be zero
            $table->string('number')->unique(); // have not to be zero
            $table->string('title');
            $table->text('description');
            $table->string('type');
            $table->string('contact');
            $table->integer('priority')->unsigned();
            $table->text('notes')->nullable();
            $table->integer('location_id')->unsigned()->index();
            $table->integer('creator')->unsigned()->index();
            $table->integer('key')->unsigned();
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
