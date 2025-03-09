<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReturnColumnsToOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->integer('return_quantity')->nullable()->after('quantity');
            $table->string('return_reason')->nullable()->after('return_quantity');
            $table->enum('return_status', ['pending', 'approved', 'rejected', 'completed'])->nullable()->after('return_reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_details', function (Blueprint $table) {
            $table->dropColumn(['return_quantity', 'return_reason', 'return_status']);
        });
    }
}
