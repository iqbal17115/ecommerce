<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVariationAttributeValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variation_attribute_values', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('product_variation_id');
            $table->uuid('attribute_value_id');
            $table->text('group_number');
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps(6);
            $table->softDeletes('deleted_at', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('variation_attribute_values');
    }
}
