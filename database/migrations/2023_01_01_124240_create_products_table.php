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
            $table->string('code', 40);
            $table->string('name', 100);
            $table->enum('type', ['GTIN', 'EAN', 'GCID', 'UPC', 'ASIN', 'ISBN'])->nullable();
            $table->string('seller_sku', 100)->nullable();
            $table->double('purchase_price', 10, 2)->nullable();
            $table->integer('opening_qty', 10, 2)->nullable();
            $table->enum('quantity_unit', ['pcs', 'kg', 'gram'])->nullable();
            $table->double('your_price', 10, 2)->nullable();
            $table->double('sale_price', 10, 2)->nullable();
            $table->double('retail_price', 10, 2)->nullable();
            $table->tinyInteger('max_order_qty')->nullable();
            $table->string('model_number', 100)->nullable();
            $table->string('model_name', 100)->nullable();
            $table->date('sale_start_date')->nullable();
            $table->date('sale_end_date')->nullable();
            $table->date('booking_date')->nullable();
            $table->date('start_selling_date')->nullable();
            $table->boolean('offering_gift_message')->nullable();
            $table->boolean('gift_wrap_available')->nullable();
            $table->boolean('brand_available')->nullable()->default(0);
            $table->string('varition_type_data', 191)->nullable();
            $table->text('variation')->nullable();
            $table->foreignId('region_publication_id')->nullable();
            $table->foreignId('category_id');
            $table->foreignId('brand_id')->nullable();
            $table->foreignId('product_feature_id')->nullable();
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('created_by');
            $table->foreignId('vendor_id')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->softDeletes();
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
