<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_addresses', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignUuid('order_id');
            $table->string('name', 50);
            $table->string('instruction')->nullable();
            $table->string('mobile');
            $table->string('optional_mobile')->nullable();
            $table->string('street_address')->nullable();
            $table->string('building_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->enum('type', ['home', 'office']);
            $table->string('country_name')->nullable();
            $table->string('division_name')->nullable();
            $table->string('district_name')->nullable();
            $table->string('upazila_name')->nullable();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->softDeletes();
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
        Schema::dropIfExists('order_addresses');
    }
}
