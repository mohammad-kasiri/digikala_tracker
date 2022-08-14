<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('crawl_code');
            $table->bigInteger('digikala_id');
            $table->string('title' , 300)->nullable();
            $table->string('brand' , 300)->nullable();
            $table->string('image' , 500)->nullable();

            $table->bigInteger('seller_id')->nullable();
            $table->string('seller_name' , 300)->nullable();
            $table->string('seller_url' , 300)->nullable();

            $table->integer('rate')->nullable();

            $table->bigInteger('selling_price')->nullable();
            $table->bigInteger('rrp_price')->nullable();
            $table->integer('order_limit')->nullable();
            $table->integer('discount_percent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
};
