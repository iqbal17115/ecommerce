<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_rates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shipping_zone_id')->index();
            $table->decimal('min_weight', 8, 2)->nullable();
            $table->decimal('max_weight', 8, 2)->nullable();
            $table->decimal('min_amount', 10, 2)->nullable();
            $table->decimal('max_amount', 10, 2)->nullable();
            $table->integer('min_qty')->default(0);
            $table->integer('max_qty')->default(0);
            $table->decimal('rate', 10, 2);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('shipping_zone_id')
                ->references('id')->on('shipping_zones')
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
        Schema::dropIfExists('shipping_rates');
    }
}
