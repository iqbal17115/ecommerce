<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRewardPointRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reward_point_rules', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->tinyInteger('event')->comment('1=Registration, 2=Order, 3=Review, 4=Referral, 5=Birthday');
            $table->integer('points')->default(0);
            $table->decimal('multiplier', 5, 2)->nullable()->comment('Optional multiplier for tiers (e.g., 1.2x)');
            $table->boolean('is_active')->default(true);
            $table->timestamps(6);
            $table->softDeletes('deleted_at', 6);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reward_point_rules');
    }
}
