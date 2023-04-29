<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FeatureSettingController extends Controller
{
    public function index() {
        return view('backend.web-setting.feature-setting');
    }
}
