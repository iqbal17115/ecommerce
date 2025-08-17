<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingInsideOutsidesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_inside_outsides', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shipping_zone_id')->index();
            $table->decimal('inside_rate', 10, 2);
            $table->decimal('outside_rate', 10, 2);
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
        Schema::dropIfExists('shipping_inside_outsides');
    }
}
