<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLineItemsTable extends Migration {

    public function up()
    {
        Schema::create('line_items', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('order_id');
            $table->integer('quantity_product');
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('line_items');
    }
}
