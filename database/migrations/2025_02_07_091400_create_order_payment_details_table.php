<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payment_details', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('order_payment_id')->nullable()->index();
            $table->date('date');
            $table->string('payment_type');
            $table->string('payment_method');
            $table->decimal('amount')->comment('The payment amount');
            $table->string('card_number')->nullable()->comment('Credit card number used for the payment');
            $table->string('transaction_number')->nullable()->comment('Unique transaction number for the payment');
            $table->string('bank_name')->nullable()->comment('Name of the bank involved in the transaction');
            $table->string('cheque_number')->nullable()->comment('Cheque number used for the payment');
            $table->string('note')->nullable()->comment('Payment Note');
            $table->string('is_successful');
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
        Schema::dropIfExists('order_payment_details');
    }
}
