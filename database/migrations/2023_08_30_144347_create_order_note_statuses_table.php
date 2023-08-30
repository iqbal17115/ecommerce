<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrderNoteStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_note_statuses', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->foreignId('order_id');
            $table->string('order_note', 100);
            $table->enum('order_note_type',[]);
            $table->enum('payment_status',[]);
            $table->string('payment_note', 100);
            $table->enum('payment_note_type',[]);
            $table->enum('fulfilment_status',[]);
            $table->string('fulfilment_note', 100);
            $table->enum('fulfilment_note_type',[]);
            $table->foreignId('created_by')->nullable()->index();
            $table->foreignId('updated_by')->nullable()->index();
            $table->foreignId('deleted_by')->nullable()->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('seo_pages', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('deleted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_note_statuses');
    }
}
