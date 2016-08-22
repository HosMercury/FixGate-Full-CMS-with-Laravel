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
            $table->enum('type',['material','asset']);
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('created_by')->unsigned()->index();

            //Size
            $table->float('width')->nullable(); // cm
            $table->float('length')->nullable(); // cm
            $table->float('height')->nullable(); // cm

            $table->string('barcode')->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('location');
            $table->string('sub_location')->nullable();
            $table->float('price')->defaults(0);//SR
            $table->integer('SOH')->defaults(0);
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
