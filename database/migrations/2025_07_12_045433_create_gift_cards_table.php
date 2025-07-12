<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateGiftCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_cards', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('code', 60)->unique();
            $table->decimal('amount', 10, 2)->default(0);
            $table->decimal('balance', 10, 2)->default(0);
            $table->string('recipient_email')->nullable();
            $table->string('sender_name')->nullable();
            $table->text('message')->nullable();
            $table->date('expiration_date')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('gift_cards');
    }
}
