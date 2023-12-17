<?php

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateSalePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_payments', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('sale_id');
            $table->decimal('total_sale_price', 10, 2);
            $table->decimal('discount', 10, 2);
            $table->decimal('shipping_charge', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->enum('payment_status', PaymentStatusEnum::getValues())->default(PaymentStatusEnum::PENDING);
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('sale_payments', function (Blueprint $table) {
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_payments');
    }
}
