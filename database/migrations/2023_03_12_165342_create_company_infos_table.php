<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('name', 100)->nullable();
            $table->text('logo')->nullable();
            $table->text('footer_logo')->nullable();
            $table->text('icon')->nullable();
            $table->text('footer_image')->nullable();
            $table->text('footer_payment_image')->nullable();
            $table->text('about_us_image')->nullable();
            $table->text('country_flag')->nullable();
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
            $table->text('twitter_link')->nullable();
            $table->text('instagram_link')->nullable();
            $table->text('linkedin_link')->nullable();
            $table->text('about_us')->nullable();
            $table->text('terms_condition')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->text('return_policy')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('footer_ads', 100)->nullable();
            $table->boolean('is_phone_active')->nullable()->default(1);
            $table->boolean('is_mobile_active')->nullable()->default(1);
            $table->boolean('is_email_active')->nullable()->default(1);
            $table->boolean('is_footer_block1_active')->nullable()->default(1);
            $table->boolean('is_footer_block2_active')->nullable()->default(1);
            $table->boolean('is_footer_block3_active')->nullable()->default(1);
            $table->boolean('is_hotline_active')->nullable()->default(1);
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
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
