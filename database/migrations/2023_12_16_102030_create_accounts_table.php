<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('account_category_id');
            $table->uuid('parent_account_id')->nullable();
            $table->string('name', 100)->unique();
            $table->string('code', 20)->unique();
            $table->decimal('opening_balance',10,2)->default(0.00)->nullable();
            $table->decimal('current_balance',10,2)->default(0.00)->nullable();
            $table->boolean('is_bank_account')->default(false);
            $table->string('bank_name', 100)->nullable();
            $table->string('bank_phone', 100)->nullable();
            $table->string('bank_address', 100)->nullable();
            $table->boolean('is_permanent')->default(false);
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('accounts', function (Blueprint $table) {
            $table->foreign('account_category_id')->references('id')->on('account_categories')->onDelete('cascade');
            $table->foreign('parent_account_id')->references('id')->on('accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
