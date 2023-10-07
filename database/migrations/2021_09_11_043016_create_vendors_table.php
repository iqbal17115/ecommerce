<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('user_id')->nullable()->index();
            $table->string('name', 191);
            $table->string('business_name', 191);
            $table->string('trade_license', 191);
            $table->string('trn_number', 15);
            $table->text('profile_photo_path')->nullable();
            $table->string('email', 100)->unique()->nullable();
            $table->string('business_location', 191);
            $table->uuid('district_id')->nullable()->index();
            $table->string('mobile')->unique()->nullable();
            $table->enum('account_type',['Individual', 'Seller']);
            $table->enum('status', ['Pending', 'Approved', 'Cancel'])->default('Pending');
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
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
        Schema::dropIfExists('vendors');
    }
}
