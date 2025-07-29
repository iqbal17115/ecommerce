<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateCartsAndCartItemsForGuestCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         // For 'carts' table
        Schema::table('carts', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('user_id')->index();
        });

        // Use raw SQL to make user_id nullable
        DB::statement('ALTER TABLE carts MODIFY user_id CHAR(36) NULL;');

        // For 'cart_items' table
        Schema::table('cart_items', function (Blueprint $table) {
            $table->string('session_id')->nullable()->after('user_id')->index();
        });

        // Use raw SQL to make user_id nullable
        DB::statement('ALTER TABLE cart_items MODIFY user_id CHAR(36) NULL;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('carts', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });

        Schema::table('cart_items', function (Blueprint $table) {
            $table->dropColumn('session_id');
        });
    }
}
