<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('outer_material', 100)->nullable();
            $table->string('seller_sku', 100)->nullable();
            $table->string('tax_code', 40)->nullable();
            $table->date('restock_date')->nullable();
            $table->text('short_deacription')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->text('condition_note')->nullable();
            $table->enum('target_gender', ['Male', 'Female', 'Unisex'])->nullable();
            $table->tinyInteger('age_range')->nullable();
            $table->uuid('product_id')->nullable()->index();
            $table->uuid('material_type_id')->nullable()->index();
            $table->uuid('condition_id')->nullable()->index();
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
        Schema::dropIfExists('product_details');
    }
}
