<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\ProductFeature;
use Illuminate\Http\Request;

class FeatureSettingController extends Controller
{
    public function addFeatureSetting(Request $request) {
        return 1;
    }
    public function index() {
        $all_features = ProductFeature::orderBy('id', 'DESC')->get();
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        return view('backend.web-setting.feature-setting', compact('all_features', 'categories'));
    }
}
