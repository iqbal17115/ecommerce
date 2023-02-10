<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->enum('page', ['Home', 'Category', 'Details']);
            $table->enum('style', ['Style One', 'Style Two', 'Style Three', 'Style Four', 'Style Five']);
            $table->enum('width', ['Full', 'Half', 'One Third']);
            $table->tinyInteger('position')->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->tinyInteger('offer')->nullable();
            $table->text('image')->nullable();
            $table->foreignId('product_feature_id')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
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
        Schema::dropIfExists('advertisements');
    }
}
