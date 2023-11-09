<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCouponProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_products', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('coupon_id')->nullable()->index();
            $table->uuid('product_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('coupon_products', function (Blueprint $table) {
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_products');
    }
}
