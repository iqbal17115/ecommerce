<?php

use App\Enums\ProductStatusEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('code', 40)->nullable();
            $table->text('name');
            $table->enum('type', ['GTIN', 'EAN', 'GCID', 'UPC', 'ASIN', 'ISBN'])->nullable();
            $table->string('seller_sku', 100)->nullable();
            $table->double('purchase_price', 10, 2)->nullable();
            $table->double('opening_qty', 10, 2)->nullable();
            $table->enum('quantity_unit', ['pcs', 'kg', 'gram'])->nullable();
            $table->double('your_price', 10, 2)->nullable();
            $table->double('sale_price', 10, 2)->nullable();
            $table->double('retail_price', 10, 2)->nullable();
            $table->integer('stock_qty', 10, 2);
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
            $table->uuid('shipping_class_id')->nullable()->index();
            $table->uuid('region_publication_id')->nullable()->index();
            $table->uuid('category_id')->nullable()->index();
            $table->uuid('brand_id')->nullable()->index();
            $table->uuid('product_feature_id')->nullable()->index();
            $table->uuid('branch_id')->nullable()->index();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->uuid('vendor_id')->nullable()->index();
            $table->enum('status', array_keys(ProductStatusEnums::getValues()));
            $table->tinyInteger('step')->default(0);
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
