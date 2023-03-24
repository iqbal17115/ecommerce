<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_infos', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->text('logo')->nullable();
            $table->text('icon')->nullable();
            $table->text('footer_image')->nullable();
            $table->text('footer_payment_image')->nullable();
            $table->string('phone', 100)->nullable();
            $table->string('mobile', 100)->nullable();
            $table->string('email', 191)->nullable();
            $table->string('hotline', 191)->nullable();
            $table->string('address', 191)->nullable();
            $table->text('google_map_location')->nullable();
            $table->string('web', 191)->nullable();
            $table->text('video_link')->nullable();
            $table->text('video_title')->nullable();
            $table->text('facebook_link')->nullable();
            $table->text('youtube_link')->nullable();
            $table->text('about_us')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('return_policy')->nullable();
            $table->boolean('is_phone_active')->nullable()->default(1);
            $table->boolean('is_mobile_active')->nullable()->default(1);
            $table->boolean('is_email_active')->nullable()->default(1);
            $table->boolean('is_footer_block1_active')->nullable()->default(1);
            $table->boolean('is_footer_block2_active')->nullable()->default(1);
            $table->boolean('is_footer_block3_active')->nullable()->default(1);
            $table->boolean('is_hotline_active')->nullable()->default(1);
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
        Schema::dropIfExists('company_infos');
    }
}