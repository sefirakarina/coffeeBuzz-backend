<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('item_type', ['food', 'drink']);
            $table->integer('food_id')->unsigned()->nullable(true);
            $table->integer('drink_id')->unsigned()->nullable(true);
        });

        Schema::table('items', function (Blueprint $table) {
            $table->foreign('food_id')->references('id')->on('foods')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('drink_id')->references('id')->on('drinks')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
