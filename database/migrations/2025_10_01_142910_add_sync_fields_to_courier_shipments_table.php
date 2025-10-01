<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSyncFieldsToCourierShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courier_shipments', function (Blueprint $table) {
            $table->timestamp('last_synced_at')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->boolean('is_final')->default(false);
            $table->integer('attempts')->default(0);
            $table->string('status_reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courier_shipments', function (Blueprint $table) {
            $table->dropColumn(['last_synced_at', 'delivered_at', 'is_final', 'attempts', 'status_reason']);
        });
    }
}
