<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->id();
            $table->string('outer_material', 100)->nullable();
            $table->string('seller_sku', 100)->nullable();
            $table->string('tax_code', 40)->nullable();
            $table->date('restock_date')->nullable();
            $table->text('short_deacription')->nullable();
            $table->text('description')->nullable();
            $table->text('condition_note')->nullable();
            $table->enum('target_gender', ['Male', 'Female', 'Unisex'])->nullable();
            $table->tinyInteger('age_range')->nullable();
            $table->foreignId('product_id')->nullable();
            $table->foreignId('material_type_id')->nullable();
            $table->foreignId('condition_id')->nullable();
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
