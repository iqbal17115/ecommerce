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
            $table->uuid('shipping_class');
            $table->decimal('charge_1', 10, 2);
            $table->decimal('charge_2', 10, 2);
            $table->integer('min_quantity')->nullable();
            $table->integer('max_quantity')->nullable();
            $table->integer('min_amount')->nullable();
            $table->integer('max_amount')->nullable();
            $table->string('free_shipping');
            $table->integer('minimum_amount_for_free_shipping')->nullable();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('shipping_charges', function (Blueprint $table) {
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods')->onDelete('cascade');
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
