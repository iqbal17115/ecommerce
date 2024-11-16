<?php

use App\Enums\CouponTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('code');
            $table->string('description')->nullable();
            $table->enum('type', array_keys(CouponTypeEnum::getCouponTypeTypes()));
            $table->decimal('value', 10, 2);
            $table->integer('max_uses')->nullable();
            $table->date('valid_from');
            $table->date('valid_to');
            $table->integer('minimum_order_amount')->nullable();
            $table->integer('usage_limit_per_user')->nullable();
            $table->integer('usage_count')->default(0);
            $table->boolean('is_active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
