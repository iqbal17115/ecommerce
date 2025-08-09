<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->uuid('id')->primary();
            $table->uuid('division_id')->nullable();
            $table->uuid('district_id')->nullable();
            $table->uuid('upazila_id')->nullable();
            $table->decimal('min_order_amount', 10, 2)->default(0);
            $table->decimal('max_order_amount', 10, 2)->default(0);
            $table->decimal('min_weight', 10, 2)->default(0);
            $table->decimal('max_weight', 10, 2)->default(0);
            $table->integer('min_qty')->default(0);
            $table->integer('max_qty')->default(0);
            $table->decimal('charge_amount', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('upazila_id')->references('id')->on('upazilas')->onDelete('cascade');

            // Indexes for efficient querying
            $table->index(['division_id', 'district_id', 'upazila_id'], 'location_full_index');
            $table->index(['district_id', 'upazila_id'], 'location_partial_index');
            $table->index(['division_id'], 'division_index');
            $table->index(['district_id'], 'district_index');
            $table->index(['upazila_id'], 'upazila_index');
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
