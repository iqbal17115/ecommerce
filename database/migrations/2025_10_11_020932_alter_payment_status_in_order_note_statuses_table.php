<?php

use App\Enums\PaymentStatusEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterPaymentStatusInOrderNoteStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Change ENUM to VARCHAR(50) using raw SQL
        DB::statement("ALTER TABLE order_note_statuses MODIFY payment_status VARCHAR(50) NULL");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert VARCHAR(50) back to ENUM
        $enumValues = "'" . implode("','", array_keys(PaymentStatusEnum::getValues())) . "'";
        DB::statement("ALTER TABLE order_note_statuses MODIFY payment_status ENUM($enumValues) NULL");
    }
}
