<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_invoices', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('code', 191);
            $table->uuid('contact_id')->nullable()->index();
            $table->dateTime('purchase_date')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('other_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->double('commission')->nullable();
            $table->double('vat')->nullable();
            $table->double('payable_amount')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('purchase_invoices');
    }
}
