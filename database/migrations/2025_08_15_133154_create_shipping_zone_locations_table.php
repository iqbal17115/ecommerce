<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingZoneLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_zone_locations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('shipping_zone_id');
            $table->uuid('division_id')->nullable()->index();
            $table->uuid('district_id')->nullable()->index();
            $table->uuid('upazila_id')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('shipping_zone_id')->references('id')->on('shipping_zones')->onDelete('cascade');
            $table->foreign('division_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
            $table->foreign('upazila_id')->references('id')->on('upazilas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_zone_locations');
    }
}
