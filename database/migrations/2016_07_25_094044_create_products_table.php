<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

    public function up()
    {
        Schema::create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->boolean('status');
            $table->string('image');
            $table->integer('quantity');
            $table->integer('rating');
            $table->integer('category_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('products');
    }
}
