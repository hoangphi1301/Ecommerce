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
            $table->string('name',255);
            $table->float('price');
            $table->float('promotion_price')->default(0);
            $table->string('image',100);
            $table->text('description')->nullable();
            $table->string('color',50);
            $table->float('weight');
            $table->integer('stock');
            $table->string('unit',50);
            $table->timestamps();
            // $table->foreign('product_type_id')->references('id')->on('product_types')->onDelete('cascade');
            // $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
