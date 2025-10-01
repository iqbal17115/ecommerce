<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courier_shipments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('order_id');
            $table->string('courier_name');
            $table->string('tracking_code')->nullable();
            $table->string('consignment_id')->nullable();
            $table->string('status')->default('pending');
            $table->longText('payload')->nullable();
            $table->longText('response')->nullable();
            $table->timestamp('dispatched_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint (optional, if orders table exists)
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courier_shipments');
    }
}
