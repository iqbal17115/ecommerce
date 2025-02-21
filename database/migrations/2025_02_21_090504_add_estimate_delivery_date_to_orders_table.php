<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddEstimateDeliveryDateToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dateTime('estimate_delivery_date')->nullable()->after('order_date');
        });

        // Set default estimate delivery date as order_date + 1 day
        DB::statement("UPDATE orders SET estimate_delivery_date = DATE_ADD(order_date, INTERVAL 1 DAY) WHERE order_date IS NOT NULL");
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('estimate_delivery_date');
        });
    }
}
