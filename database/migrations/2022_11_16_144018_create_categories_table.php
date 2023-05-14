<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->foreignId('parent_category_id')->nullable();
            $table->foreignId('product_feature_id')->nullable();
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
            $table->foreignId('branch_id');
            $table->foreignId('user_id');
            $table->boolean('is_active')->nullable()->default(1);
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
