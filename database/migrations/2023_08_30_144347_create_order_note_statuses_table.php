<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentStatusEnum;
use Illuminate\Support\Facades\Schema;

class CreateOrderNoteStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_note_statuses', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignId('order_id');
            $table->string('order_note', 100);
            $table->enum('order_note_type',['private', 'note_to_customer']);
            $table->enum('payment_status',array_values(PaymentStatusEnum::getPaymentStatuses()));
            $table->string('payment_note', 100);
            $table->enum('payment_note_type',['private', 'note_to_customer']);
            $table->enum('fulfilment_status', array_values(OrderStatusEnum::getOrderStatuses()));
            $table->string('fulfilment_note', 100);
            $table->enum('fulfilment_note_type',['private', 'note_to_customer']);
            $table->foreignId('created_by')->nullable()->index();
            $table->foreignId('updated_by')->nullable()->index();
            $table->foreignId('deleted_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('order_note_statuses', function (Blueprint $table) {
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
        Schema::dropIfExists('order_note_statuses');
    }
}
