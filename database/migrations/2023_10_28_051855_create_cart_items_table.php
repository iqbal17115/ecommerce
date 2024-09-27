<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->foreignUuid('product_id')->nullable()->index();
            $table->foreignUuid('product_variation_id')->nullable();
            $table->integer('quantity');
            $table->boolean('is_active')->nullable()->default(0);
            $table->timestamps();

            // Foreign key constraint (if needed)
            $table->foreign('product_variation_id')->references('id')->on('product_variations')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
}
