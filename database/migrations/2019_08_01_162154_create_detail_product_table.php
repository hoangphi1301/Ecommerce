<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('size')->nullable();  
            $table->string('weight')->nullable();
            $table->string('display')->nullable();
            $table->string('resolution')->nullable();
            $table->string('system')->nullable();
            $table->string('storage')->nullable();
            $table->string('ram')->nullable();
            $table->string('cpu')->nullable();
            $table->string('gpu')->nullable();
            $table->string('camera')->nullable();
            $table->string('bluetooth')->nullable();
            $table->string('wlan')->nullable();
            $table->string('gps')->nullable();
            $table->string('port')->nullable();
            $table->string('battery')->nullable();
            $table->string('other')->nullable();
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_product');
    }
}
