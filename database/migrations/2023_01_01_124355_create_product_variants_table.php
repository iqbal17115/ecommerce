<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('size', 40)->nullable();
            $table->string('bottom_size', 40)->nullable();
            $table->string('bottom_size_map', 40)->nullable();
            $table->string('color', 40)->nullable();
            $table->string('color_map', 40)->nullable();
            $table->string('package_qty', 40)->nullable();
            $table->string('material_type', 40)->nullable();
            $table->string('wattage', 40)->nullable();
            $table->string('number_of_item', 40)->nullable();
            $table->string('style_name', 40)->nullable();
            $table->enum('target_gender', ['Male', 'Female', 'Unisex'])->nullable();
            $table->string('description', 100)->nullable();
            $table->string('seller_sku', 40)->nullable();
            $table->string('product_code', 40)->nullable();
            $table->enum('type', ['GTIN', 'EAN', 'GCID', 'UPC', 'ASIN', 'ISBN'])->nullable();
            $table->double('price', 20, 4)->nullable();
            $table->double('quantity', 20, 4)->nullable();
            $table->foreignId('condition_id')->nullable();
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
        Schema::dropIfExists('product_variants');
    }
}
