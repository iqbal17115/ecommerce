<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('(UUID())'));
            $table->uuid('user_id')->index(); // Nullable for guest users
            $table->uuid('coupon_id')->nullable()->index(); // Applied coupon ID
            $table->decimal('coupon_discount', 10, 2)->nullable(); // Total discount from coupon
            $table->decimal('subtotal', 15, 2)->nullable(); // Cart subtotal before discount
            $table->decimal('total', 15, 2)->nullable(); // Cart total after discount
            $table->boolean('is_active')->default(true); // Indicates active/inactive cart
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
        Schema::dropIfExists('carts');
    }
}
