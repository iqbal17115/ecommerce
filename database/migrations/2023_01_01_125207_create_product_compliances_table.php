<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductCompliancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_compliances', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('battery_cell_type', 60)->nullable();
            $table->string('battery_type', 40)->nullable();
            $table->integer('number_of_battery_require')->nullable();
            $table->integer('lithium_battery_energy_content')->nullable();
            $table->string('lithium_battery_energy_content_unit', 50)->nullable();
            $table->tinyInteger('lithium_battery_packaging')->nullable()->comment('1 for Batteries Packed With Equipment, 2 for Batteries Contained In Equipment, 3 for Batteries Only');
            $table->boolean('battery_include')->nullable();
            $table->boolean('battery_require')->nullable();
            $table->integer('battery_weight')->nullable();
            $table->string('battery_weight_unit', 30)->nullable();
            $table->integer('number_of_lithium_metal_cell')->nullable();
            $table->integer('number_of_lithium_ion_cell')->nullable();
            $table->double('lithium_battery_weight', 10, 2)->nullable();
            $table->string('lithium_battery_weight_unit', 30)->nullable();
            $table->string('regulatory_id', 50)->nullable();
            $table->text('safety_data_sheet_url')->nullable();
            $table->double('volume', 10, 2)->nullable();
            $table->string('volume_unit', 30)->nullable();
            $table->integer('flash_point')->nullable();
            $table->double('item_weight', 10, 2)->nullable();
            $table->string('item_weight_unit', 30)->nullable();
            $table->uuid('product_id')->nullable()->index();
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
        Schema::dropIfExists('product_compliances');
    }
}
