<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drinks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name_id')->unsigned();
            $table->integer('size_id')->unsigned();
            $table->integer(('price'));
        });

        Schema::table('drinks', function (Blueprint $table) {
            $table->foreign('size_id')->references('id')->on('drink_sizes');
            $table->foreign('name_id')->references('id')->on('drink_names');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drinks');
    }
}
