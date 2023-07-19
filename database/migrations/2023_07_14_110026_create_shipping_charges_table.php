<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('shipping_method_id');
            $table->uuid('shipping_class_id');
            $table->decimal('from_area',8, 4);
            $table->decimal('to_area', 8, 4);
            $table->decimal('from_weight', 8, 4);
            $table->decimal('to_weight', 8, 4);
            $table->decimal('charge', 8, 2);
            $table->integer('min_quantity')->nullable();
            $table->integer('max_quantity')->nullable();
            $table->decimal('min_amount', 8, 2)->nullable();
            $table->decimal('max_amount', 8, 2)->nullable();
            $table->string('free_shipping');
            $table->decimal('minimum_amount_for_free_shipping', 8, 2)->nullable();
            $table->timestamps();
        });

        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods')->onDelete('cascade');
            $table->foreign('shipping_class_id')->references('id')->on('shipping_classes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_charges');
    }
}
