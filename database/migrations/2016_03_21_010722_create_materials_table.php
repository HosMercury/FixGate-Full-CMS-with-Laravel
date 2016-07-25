<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaterialsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('type',['asset','material']);
            $table->string('title');
            $table->string('description');
            $table->string('size')->nullable();
            $table->string('barcode')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('store');
            $table->string('substore')->nullable();
            $table->integer('price');
            $table->integer('SOH');
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
        Schema::drop('materials');
    }
}
