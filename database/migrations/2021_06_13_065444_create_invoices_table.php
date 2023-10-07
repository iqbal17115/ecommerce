<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->enum('type', ['Order', 'Sales', 'Purchase', 'Quate']);
            $table->timestamp('date');
            $table->string('code', 100)->nullable();
            $table->uuid('contact_id')->nullable()->index();
            $table->double('subtotal', 20, 4)->nullable();
            $table->double('vat_total', 20, 4)->nullable();
            $table->double('discount_value', 20, 4)->nullable();
            $table->double('discount', 20, 4)->nullable();
            $table->double('shipping_charge', 20, 4)->nullable();
            $table->double('earn_point', 20, 4)->nullable();
            $table->double('earn_point_amount', 20, 4)->nullable();
            $table->double('expense_point', 20, 4)->nullable();
            $table->double('expense_point_amount', 20, 4)->nullable();
            $table->double('grand_total', 20, 4)->nullable();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->uuid('branch_id')->nullable()->index();
            $table->enum('status', ['Pending', 'In Process', 'Delivered', 'Accepted', 'Rescheduled', 'Picked Up', 'Cancel', 'Return']);
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
        Schema::dropIfExists('invoices');
    }
}
