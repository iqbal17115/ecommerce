<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Backend\WebSetting\CompanyInfo;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CompanyInfoController extends Controller
{
    public  $cacheService;
    public function __construct(CacheService $cacheService)
    {
        $this->cacheService = $cacheService;
    }

    // Title Save
    public function Title(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->title = $request->title;
        $company_info->save();
        return response()->json([
            'status' => 201
        ]);
    }
    //End  Title Save


    // Keyword Save
    public function keyword(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->key_word = $request->key_word;
        $company_info->save();
        return response()->json([
            'status' => 201
        ]);
    }
    //End  Keyword Save


    // Start Description Save
    public function description(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->description = $request->description;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    // End  Description Save


    public function addStatus(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->is_footer_block1_active = $request->is_footer_block1_active == null ? 0 : 1;
        $company_info->is_footer_block2_active = $request->is_footer_block2_active == null ? 0 : 1;
        $company_info->is_footer_block3_active = $request->is_footer_block3_active == null ? 0 : 1;
        $company_info->save();
        return response()->json([
            'status' => 201
        ]);
    }
    public function addShippingAndDelivery(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->shipping_and_delivery = $request->shipping_and_delivery;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }




    public function addReturnPolicy(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->return_policy = $request->return_policy;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    public function addPrivacyPolicy(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->privacy_policy = $request->privacy_policy;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    public function addTermsCondition(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->terms_condition = $request->terms_condition;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    public function addAboutUs(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->about_us = $request->about_us;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    public function addLink(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->video_link = $request->video_link;
        $company_info->video_title = $request->video_title;
        $company_info->facebook_link = $request->facebook_link;
        $company_info->youtube_link = $request->youtube_link;
        $company_info->twitter_link = $request->twitter_link;
        $company_info->instagram_link = $request->instagram_link;
        $company_info->linkedin_link = $request->linkedin_link;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    public function addVitalInfo(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->name = $request->name;

        if ($request->file('logo')) {
            $logoPath = $request->file('logo');
            $logoName = $logoPath->getClientOriginalName();
            $path = $request->file('logo')->storeAs('uploads', $logoName, 'public');
            $logo = $request->file('logo')->store('company_info/logos', 'public');
            $company_info->logo = $logo;
        }

        if ($request->file('footer_logo')) {
            $footer_logoPath = $request->file('footer_logo');
            $footer_logoName = $footer_logoPath->getClientOriginalName();
            $path = $request->file('footer_logo')->storeAs('uploads', $footer_logoName, 'public');
            $footer_logo = $request->file('footer_logo')->store('company_info/footer_logos', 'public');
            $company_info->footer_logo = $footer_logo;
        }

        if ($request->file('icon')) {
            $iconPath = $request->file('icon');
            $iconName = $iconPath->getClientOriginalName();
            $path = $request->file('icon')->storeAs('uploads', $iconName, 'public');
            $icon = $request->file('icon')->store('company_info/icons', 'public');
            $company_info->icon = $icon;
        }

        if ($request->file('footer_image')) {
            $footer_imagePath = $request->file('footer_image');
            $footer_imageName = $footer_imagePath->getClientOriginalName();
            $path = $request->file('footer_image')->storeAs('uploads', $footer_imageName, 'public');
            $footer_image = $request->file('footer_image')->store('company_info/footer_images', 'public');
            $company_info->footer_image = $footer_image;
        }

        if ($request->file('footer_payment_image')) {
            $footer_payment_imagePath = $request->file('footer_payment_image');
            $footer_payment_imageName = $footer_payment_imagePath->getClientOriginalName();
            $path = $request->file('footer_payment_image')->storeAs('uploads', $footer_payment_imageName, 'public');
            $footer_payment_image = $request->file('footer_payment_image')->store('company_info/footer_payment_images', 'public');
            $company_info->footer_payment_image = $footer_payment_image;
        }

        if ($request->file('country_flag')) {
            $country_flagPath = $request->file('country_flag');
            $country_flagName = $country_flagPath->getClientOriginalName();
            $path = $request->file('country_flag')->storeAs('uploads', $country_flagName, 'public');
            $country_flag = $request->file('country_flag')->store('company_info/country_flags', 'public');
            $company_info->country_flag = $country_flag;
        }

        if ($request->file('about_us_image')) {
            $about_us_imagePath = $request->file('about_us_image');
            $about_us_imageName = $about_us_imagePath->getClientOriginalName();
            $path = $request->file('about_us_image')->storeAs('uploads', $about_us_imageName, 'public');
            $about_us_image = $request->file('about_us_image')->store('company_info/about_us_images', 'public');
            $company_info->about_us_image = $about_us_image;
        }


        $company_info->footer_ads = $request->footer_ads;
        $company_info->phone = $request->phone;
        $company_info->is_phone_active = $request->is_phone_active == null ? 0 : 1;
        $company_info->mobile = $request->mobile;
        $company_info->is_mobile_active = $request->is_mobile_active == null ? 0 : 1;
        $company_info->email = $request->email;
        $company_info->is_email_active = $request->is_email_active == null ? 0 : 1;
        $company_info->hotline = $request->hotline;
        $company_info->is_hotline_active = $request->is_hotline_active == null ? 0 : 1;
        $company_info->address = $request->address;
        $company_info->google_map_location = $request->google_map_location;
        $company_info->web = $request->web;
        $company_info->free_shipping_text = $request->free_shipping_text;
        $company_info->save();

        $company_info = $this->cacheService->remember('company_info', function () {
            return CompanyInfo::first();
        }, 3600);

        return response()->json([
            'status' => 201
        ]);
    }

    public function index()
    {
        // To forget the cache
        Cache::forget('company_info');

        $company_info = $this->cacheService->rememberKey('company_info', function () {
            return CompanyInfo::first();
        }, 3600);

        return view('backend.setting.company-info', compact('company_info'));
    }
}
