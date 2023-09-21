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
            $table->foreignId('user_id'); // Assuming this links to the users table
            $table->string('mobile');
            $table->string('optional_mobile')->nullable();
            $table->string('street_address')->nullable();
            $table->string('building_name')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->enum('type', ['home', 'office']); // Address type: home or office
            $table->boolean('is_default')->default(false);
            $table->uuid('district_id')->index(); // Foreign key to districts table
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
        Schema::dropIfExists('addresses');
    }
}
