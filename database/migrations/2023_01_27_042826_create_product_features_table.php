<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_features', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('name', 100);
            $table->tinyInteger('card_feature')->nullable();
            $table->boolean('feature_type')->nullable();
            $table->boolean('top_menu')->nullable();
            $table->tinyInteger('position')->nullable();
            $table->uuid('product_feature_id')->nullable()->index();
            $table->boolean('is_active')->nullable()->default(1);
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
        });

        Schema::table('product_features', function (Blueprint $table) {
            $table->foreign('product_feature_id')->references('id')->on('product_features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_features');
    }
}
