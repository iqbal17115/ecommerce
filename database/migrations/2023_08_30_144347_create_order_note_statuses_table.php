<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->uuid('order_id')->nullable()->index();
            $table->longText('order_note')->nullable();
            $table->enum('payment_status',array_keys(PaymentStatusEnum::getValues()))->nullable();
            $table->longText('payment_note')->nullable();
            $table->longText('fulfilment_note')->nullable();
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
        Schema::dropIfExists('order_note_statuses');
    }
}
