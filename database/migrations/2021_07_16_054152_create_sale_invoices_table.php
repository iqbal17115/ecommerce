<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSaleInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoices', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('code', 191);
            $table->uuid('order_id')->nullable()->index();
            $table->foreignUuid('user_id')->nullable()->index();
            $table->dateTime('sale_date')->nullable();
            $table->double('total_amount')->nullable();
            $table->double('other_amount')->nullable();
            $table->double('discount')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->double('vat')->nullable();
            $table->double('payable_amount')->nullable();
            $table->text('note')->nullable();
            $table->enum('invoice_channel', ['Web-Sale', 'Sale-Terminal'])->comment('Backend Sale or Online Sale');
            $table->uuid('coupon_code_id')->nullable()->index();
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
        Schema::dropIfExists('sale_invoices');
    }
}
