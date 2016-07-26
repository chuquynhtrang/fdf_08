<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('avatar');
            $table->string('address');
            $table->integer('phone');
            $table->string('email');
            $table->integer('role');
            $table->string('password');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
