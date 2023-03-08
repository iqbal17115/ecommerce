<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_charges', function (Blueprint $table) {
            $table->id();
            $table->enum('dimension_type', ['PerUnit', 'Range'])->nullable();
            $table->enum('type', ['Weight', 'Area', 'Default'])->nullable();
            $table->double('start', 10, 2)->nullable();
            $table->double('end', 10, 2)->nullable();
            $table->double('inside_amount', 10, 2)->nullable();
            $table->double('outside_amount', 10, 2)->nullable();
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('shipping_charges');
    }
}