<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('product_name');
            $table->string('product_slug')->nullable();
            $table->text('product_description');
            $table->text('product_short_tdescripton');
            $table->unsignedBigInteger('product_category');
            $table->foreign('product_category')->references('id')->on('categories');
            $table->string('category_brand')->nullable();
            $table->string('product_regular_price');
            $table->string('product_sale_price')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('product_quantity')->nullable();
            $table->string('product_stock');
            $table->string('product_future_image');
            $table->string('product_gallery_img1');
            $table->string('product_gallery_img2');
            $table->string('product_gallery_img3')->nullable();
            $table->string('product_gallery_img4')->nullable();
            $table->string('post_status');
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
        Schema::dropIfExists('products');
    }
}
