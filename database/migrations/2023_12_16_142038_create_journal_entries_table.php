<?php

use App\Enums\EntryTypeEnums;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('transaction_id');
            $table->uuid('account_id');
            $table->decimal('amount', 10, 2)->default(0.00);
            $table->decimal('current_balance', 10, 2)->default(0.00);
            $table->enum('entry_type', EntryTypeEnums::getValues());
            $table->text('notes');
            $table->char('payment_id', 36)->nullable();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('journal_entries', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_entries');
    }
}
