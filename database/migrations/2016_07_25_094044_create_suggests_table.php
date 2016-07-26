<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSuggestsTable extends Migration {

    public function up()
    {
        Schema::create('suggests', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('category_id');
            $table->string('name');
            $table->integer('price');
            $table->string('image');
            $table->string('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('suggests');
    }
}
