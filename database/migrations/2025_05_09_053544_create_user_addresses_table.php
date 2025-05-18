<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignUuid('user_id');
            $table->foreignUuid('country_id')->nullable()->index();
            $table->foreignUuid('division_id')->nullable()->index();
            $table->foreignUuid('district_id')->nullable()->index();
            $table->foreignUuid('upazila_id')->nullable()->index();
            $table->string('full_name');
            $table->string('mobile');
            $table->string('optional_mobile')->nullable();
            $table->string('street_address')->nullable();
            $table->string('building_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->string('type', 50)->default('home');
            $table->boolean('is_default')->default(false);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('user_addresses');
    }
}
