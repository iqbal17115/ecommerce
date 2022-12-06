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
            $table->tinyInteger('position')->nullable();
            $table->enum('style', ['Style One', 'Style Two', 'Style Three']);
            $table->enum('type', ['Embed Code', 'Image Ads']);
            $table->text('embed_code_or_image1')->nullable();
            $table->text('embed_code_or_image2')->nullable();
            $table->text('embed_code_or_image3')->nullable();
            $table->text('url1')->nullable();
            $table->text('url2')->nullable();
            $table->text('url3')->nullable();
            $table->boolean('is_active')->nullable()->default(1);
            $table->softDeletes();
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
