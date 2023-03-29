<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Backend\WebSetting\CompanyInfo;
use Illuminate\Http\Request;

class CompanyInfoController extends Controller
{
    public function addStatus(Request $request)
    {
        $company_info = CompanyInfo::firstOrNew();
        $company_info->is_phone_active = $request->is_phone_active == null ? 0 : 1;
        $company_info->is_mobile_active = $request->is_mobile_active == null ? 0 : 1;
        $company_info->is_email_active = $request->is_email_active == null ? 0 : 1;
        $company_info->is_hotline_active = $request->is_hotline_active == null ? 0 : 1;
        $company_info->is_footer_block1_active = $request->is_footer_block1_active == null ? 0 : 1;
        $company_info->is_footer_block2_active = $request->is_footer_block2_active == null ? 0 : 1;
        $company_info->is_footer_block3_active = $request->is_footer_block3_active == null ? 0 : 1;
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
        
        $company_info->footer_ads = $request->footer_ads;
        $company_info->phone = $request->phone;
        $company_info->mobile = $request->mobile;
        $company_info->email = $request->email;
        $company_info->hotline = $request->hotline;
        $company_info->address = $request->address;
        $company_info->google_map_location = $request->google_map_location;
        $company_info->web = $request->web;
        $company_info->save();

        return response()->json([
            'status' => 201
        ]);
    }
    public function index()
    {
        $company_info = CompanyInfo::first();
        return view('backend.setting.company-info', compact('company_info'));
    }
}