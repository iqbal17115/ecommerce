<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Step 0: Remove all existing data
        DB::table('product_variants')->truncate();

        // Step 1: Drop all old columns except 'id'
        Schema::table('product_variants', function (Blueprint $table) {
            $columns = Schema::getColumnListing('product_variants');
            foreach ($columns as $column) {
                if ($column !== 'id') {
                    $table->dropColumn($column);
                }
            }
        });

        // Step 2: Add new columns
        Schema::table('product_variants', function (Blueprint $table) {
            $table->uuid('product_id')->index();
            $table->string('name', 100);
            $table->boolean('is_image_variant')->default(false);
            $table->unsignedTinyInteger('sort_order')->default(1);
            $table->timestamps();

            // Add foreign key
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
}
