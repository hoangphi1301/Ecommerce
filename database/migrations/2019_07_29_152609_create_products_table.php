<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_type_id')->unsigned();
            $table->integer('brand_id')->unsigned();
            $table->integer('color_id')->unsigned();
            $table->string('name');
            $table->integer('price');
            $table->integer('promotion_price')->default(1);
            $table->string('image')->default('default.jpg')->nullable();
            $table->text('description')->nullable();
            $table->integer('amount');
            $table->timestamps();
        });

        Schema::table('products',function(Blueprint $table){
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('color_id')->references('id')->on('colors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
