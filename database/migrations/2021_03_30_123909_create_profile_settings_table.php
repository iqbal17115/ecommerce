<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProfileSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_settings', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('profile_photo', 100)->nullable();
			$table->string('business_name', 100)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('name', 100)->nullable();
			$table->text('address')->nullable();
			$table->string('mobile', 100)->nullable();
			$table->string('postal_code', 100)->nullable();
			$table->string('city', 100)->nullable();
			$table->string('country', 100)->nullable();
            $table->uuid('company_id')->nullable()->index();
            $table->uuid('branch_id')->nullable()->index();
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('profile_settings');
    }
}
