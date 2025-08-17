<?php

use App\Enums\OrderStatusEnum;
use App\Enums\ShippingZoneTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_zones', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name'); // e.g., Inside Dhaka, Outside Dhaka, Chittagong Zone
            $table->enum('type', array_keys(ShippingZoneTypeEnum::getShippingZoneTypes()))->default('inside_outside');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('shipping_zones');
    }
}
