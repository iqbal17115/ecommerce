<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateCombinationOptionPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('combination_option_pivots', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->uuid('product_combination_id')->index();
            $table->uuid('variant_option_id')->index();
            $table->timestamps();
        });

        Schema::table('combination_option_pivots', function (Blueprint $table) {
            $table->foreign('product_combination_id')->references('id')->on('product_combinations')->onDelete('cascade');
            $table->foreign('variant_option_id')->references('id')->on('variant_options')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('combination_option_pivots');
    }
}
