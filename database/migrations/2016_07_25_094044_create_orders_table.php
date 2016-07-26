<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

    public function up()
    {
        Schema::create('orders', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('price');
            $table->integer('status');
            $table->string('shipping_address');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('orders');
    }
}
