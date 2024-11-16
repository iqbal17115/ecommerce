<?php

use App\Enums\PaymentMethodEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSalePaymentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_payment_details', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('sale_payment_id');
            $table->uuid('sale_payment_transaction_id');
            $table->enum('payment_method', array_keys(PaymentMethodEnum::getValues()));
            $table->float('amount', 10, 2);
            $table->string('card_number')->nullable();
            $table->string('transaction_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('cheque_number')->nullable();
            $table->boolean('is_successful')->default(true);
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sale_payment_details', function (Blueprint $table) {
            $table->foreign('sale_payment_id')->references('id')->on('sale_payments')->onDelete('cascade');
            $table->foreign('sale_payment_transaction_id')->references('id')->on('sale_payment_transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_payment_details');
    }
}
