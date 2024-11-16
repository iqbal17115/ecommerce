<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductMoreDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_more_details', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('closure_type', 100)->nullable();
            $table->string('manufacturer', 100)->nullable();
            $table->string('manufacturer_part_number', 60)->nullable();
            $table->integer('number_of_item')->nullable();
            $table->date('release_date')->nullable();
            $table->string('fabric_type', 60)->nullable();
            $table->double('item_length', 10, 4)->nullable();
            $table->string('item_length_unit', 30)->nullable();
            $table->double('item_width', 10, 4)->nullable();
            $table->string('item_width_unit', 30)->nullable();
            $table->double('item_height', 10, 4)->nullable();
            $table->string('item_height_unit', 30)->nullable();
            $table->double('package_height', 10, 4)->nullable();
            $table->string('package_height_unit', 30)->nullable();
            $table->double('package_length', 10, 4)->nullable();
            $table->string('package_length_unit', 30)->nullable();
            $table->double('package_width', 10, 4)->nullable();
            $table->string('package_width_unit', 30)->nullable();
            $table->double('package_weight', 10, 4)->nullable();
            $table->string('package_weight_unit', 30)->nullable();
            $table->string('league_name', 80)->nullable();
            $table->float('warranty', 10, 1)->nullable();
            $table->enum('warranty_unit', ['day', 'month', 'year'])->nullable();
            $table->text('warranty_description')->nullable();
            $table->text('product_keyword')->nullable();
            $table->string('team_name', 80)->nullable();
            $table->string('age_range_description', 100)->nullable();
            $table->string('lining_description', 100)->nullable();
            $table->string('strap_type', 80)->nullable();
            $table->string('handle_type', 80)->nullable();
            $table->integer('number_of_compartment')->nullable();
            $table->integer('number_of_wheel')->nullable();
            $table->string('pocket_description', 100)->nullable();
            $table->string('sheel_type', 60)->nullable();
            $table->string('wheel_type', 60)->nullable();
            $table->uuid('product_id')->nullable()->index();
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
        Schema::dropIfExists('product_more_details');
    }
}
