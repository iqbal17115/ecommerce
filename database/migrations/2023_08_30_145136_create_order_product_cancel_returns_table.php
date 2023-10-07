<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductCancelReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_product_cancel_returns', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('order_id')->nullable()->index();
            $table->tinyInteger('nox_no');
            $table->double('weight', 10, 4)->nullable();
            $table->string('weight_unit', 30)->nullable();
            $table->double('length', 10, 4)->nullable();
            $table->string('length_unit', 30)->nullable();
            $table->double('width', 10, 4)->nullable();
            $table->string('width_unit', 30)->nullable();
            $table->double('height', 10, 4)->nullable();
            $table->string('height_unit', 30)->nullable();
            $table->date('pickup_day')->nullable();
            $table->string('pickup_time')->nullable();
            $table->string('product_info')->nullable();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('order_product_cancel_returns', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product_cancel_returns');
    }
}
