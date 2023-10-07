<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_settings', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->enum('type',['Invoice','Receipt']);
            $table->string('logo',200)->nullable();
            $table->string('invoice_header',200)->nullable();
            $table->string('invoice_title',200)->nullable();
            $table->text('invoice_footer')->nullable();
            $table->string('vat_reg_no',20)->nullable();
            $table->string('vat_area_code',20)->nullable();
            $table->string('vat_text',100)->nullable();
            $table->string('website',100)->nullable();
            $table->uuid('currency_id')->nullable()->index();
            $table->boolean('is_paid_due_hide')->nullable()->default(0);
            $table->boolean('is_memo_no_hide')->nullable()->default(0);
            $table->boolean('is_chalan_no_hide')->nullable()->default(0);
            $table->uuid('branch_id')->nullable()->index();
            $table->uuid('created_by')->nullable()->index();
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
        Schema::dropIfExists('invoice_settings');
    }
}
