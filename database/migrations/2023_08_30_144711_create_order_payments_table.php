<?php

use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_payments', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('order_id')->nullable()->index();
            $table->decimal('total_order_price');
            $table->decimal('total_discount_amount')->default(0);
            $table->decimal('total_shipping_charge_amount')->default(0);
            $table->decimal('total_amount')->default(0);
            $table->decimal('amount_paid');
            $table->decimal('due_amount');
            $table->decimal('total_receive_amount')->default(0);
            $table->string('payment_status');
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
        Schema::dropIfExists('order_payments');
    }
}
