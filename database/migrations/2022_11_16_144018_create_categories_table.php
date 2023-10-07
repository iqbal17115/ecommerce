<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('name', 50);
            $table->uuid('parent_category_id')->nullable()->index();
            $table->uuid('product_feature_id')->nullable()->index();
            $table->boolean('top_menu')->nullable()->default(0);
            $table->boolean('sidebar_menu')->nullable()->default(0);
            $table->boolean('header_menu')->nullable()->default(0);
            $table->tinyInteger('position')->nullable();
            $table->tinyInteger('sidebar_menu_position')->nullable();
            $table->tinyInteger('header_menu_position')->nullable();
            $table->text('icon')->nullable();
            $table->text('image')->nullable();
            $table->double('vendor_commission_percentage')->nullable();
            $table->string('variation_type')->nullable();
            $table->uuid('branch_id')->nullable()->index();
            $table->uuid('user_id')->nullable()->index();
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('categories');
    }
}
