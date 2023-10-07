<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('code')->nullable();
            $table->string('date')->nullable();
            $table->enum('type', ['CustomerPayment', 'SupplierPayment']);
            $table->uuid('contact_id')->nullable()->index();
            $table->uuid('invoice_id')->nullable()->index();
            $table->double('amount', 20,4)->nullable();
            $table->double('charge', 20,4)->nullable();
            $table->double('net_amount', 20,4)->nullable();
            $table->uuid('payment_method_id')->nullable()->index();
            $table->string('transaction_id')->nullable();
            $table->string('receipt_no')->nullable();
            $table->string('note',500)->nullable();
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
        Schema::dropIfExists('payments');
    }
}
