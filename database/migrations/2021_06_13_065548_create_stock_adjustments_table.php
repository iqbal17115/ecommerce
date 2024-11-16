<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustments', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->date('date');
            $table->enum('type',['Transfer','Decrease','Increase']);
            $table->foreignUuid('user_id')->nullable()->index();
            $table->uuid('from_branch_id')->nullable()->index();
            $table->uuid('to_branch_id')->nullable()->index();
            $table->uuid('from_warehouse_id')->nullable()->index();
            $table->uuid('to_warehouse_id')->nullable()->index();
            $table->string('note')->nullable();
            $table->uuid('branch_id')->nullable()->index();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->boolean('is_active')->nullable()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_adjustments');
    }
}
