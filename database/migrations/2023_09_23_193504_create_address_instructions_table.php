<?php

use App\Enums\DayOfWeekEnum;
use App\Enums\PropertyTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateAddressInstructionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('address_instructions', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignId('user_id');
            $table->uuid('address_id')->index();
            $table->enum('property_type', array_keys(PropertyTypeEnum::getPropertyTypes()))->nullable();
            $table->enum('closed_day_for_delivery', array_keys(DayOfWeekEnum::getDaysOfWeek()))->nullable();
            $table->string('package_leave_address');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('address_instructions', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('address_instructions');
    }
}
