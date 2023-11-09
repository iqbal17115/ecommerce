<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCouponUserUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupon_user_usages', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->uuid('coupon_id')->nullable()->index();
            $table->uuid('order_id')->nullable()->index();
            $table->uuid('product_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('coupon_user_usages', function (Blueprint $table) {
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_user_usages');
    }
}
