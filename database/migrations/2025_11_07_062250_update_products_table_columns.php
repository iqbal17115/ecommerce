<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop all columns except 'id' and 'name'
            $columns = Schema::getColumnListing('products');
            foreach ($columns as $column) {
                if (!in_array($column, ['id', 'product_feature_id', 'name'])) {
                    $table->dropColumn($column);
                }
            }
        });

        Schema::table('products', function (Blueprint $table) {
            $table->uuid('brand_id')->nullable()->index();
            $table->uuid('category_id')->nullable();
            $table->longText('description');
            $table->text('short_description')->nullable();
            $table->text('highlights')->nullable();
            $table->enum('status', ['draft', 'active', 'archived'])->default('draft');
            $table->timestamps();
            $table->softDeletes('deleted_at', 6);

            // Add foreign keys
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
