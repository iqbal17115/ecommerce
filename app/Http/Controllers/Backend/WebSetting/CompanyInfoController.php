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

        if ($request->file('icon')) {
            $iconPath = $request->file('icon');
            $iconName = $iconPath->getClientOriginalName();
            $path = $request->file('icon')->storeAs('uploads', $iconName, 'public');
            $icon = $request->file('icon')->store('company_info/icons', 'public');
            $company_info->icon = $icon;
        }

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