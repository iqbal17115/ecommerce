<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignUuid('user_id'); // Assuming this links to the users table
            $table->string('name', 50);
            $table->string('instruction')->nullable();
            $table->string('mobile');
            $table->string('optional_mobile')->nullable();
            $table->string('street_address')->nullable();
            $table->string('building_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->enum('type', ['home', 'office']); // Address type: home or office
            $table->boolean('is_default')->default(false);
            $table->uuid('country_id')->index();
            $table->uuid('division_id')->index();
            $table->uuid('district_id')->index();
            $table->uuid('upazila_id')->index();
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->foreign('district_id')->references('id')->on('districts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
