<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\ProductFeature;
use App\Models\Backend\WebSetting\FeatureSetting;
use App\Models\Backend\WebSetting\FeatureSettingDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class FeatureSettingController extends Controller
{
    public function featureSettingList() {
        $feature_settings = FeatureSetting::orderBy('id', 'DESC')->get();
    
        return view('backend.web-setting.feature-setting-list', compact('feature_settings'));
    }
    public function addFeatureSetting(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $ProductFeatureQuery = ProductFeature::whereId($request->feature_id)->first();
            $ProductFeatureQuery->position = $request->feature_position;
            $ProductFeatureQuery->card_feature = $request->card_feature;
            $ProductFeatureQuery->top_menu = $request->top_menu;
            $ProductFeatureQuery->save();

            $Query = FeatureSetting::whereProductFeatureId($request->feature_id)->first();
            if (!$Query) {
                $Query = new FeatureSetting();
            }
            
            $Query->parent_product_feature_id = $request->parent_product_feature_id;
            $Query->product_feature_id = $request->feature_id;
            $Query->apply_for_offer = $request->apply_for_offer;
            $Query->apply_for_coupon = $request->apply_for_coupon;
            $Query->save();
            FeatureSettingDetail::whereFeatureSettingId($Query->id)->whereNotIn('category_id', $request->category_id)->delete();
            foreach($request->category_id as $key => $category_id) {
                $FeatureSettingQuery = FeatureSettingDetail::whereFeatureSettingId($Query->id)->whereCategoryId($category_id)->first();
                if (!$FeatureSettingQuery) {
                    $FeatureSettingQuery = new FeatureSettingDetail();
                }
                $FeatureSettingQuery->feature_setting_id = $Query->id;
                $FeatureSettingQuery->category_id = $category_id;
                $FeatureSettingQuery->position = $request->position[$key];
                $FeatureSettingQuery->save();
            }
            return response()->json(['product_id' => $Query->id, 'status' => 201]);
        });
    }
    public function index(Request $request)
    {
        $all_features = ProductFeature::orderBy('id', 'DESC')->get();
        $all_card_features = ProductFeature::orderBy('id', 'DESC')->get();
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
       $featureSettingInfo = null;
        $featureInfo = null;
        $id = $request->id;
        if ($id) {
            $featureSettingInfo = FeatureSetting::whereId($id)->first();
            $featureInfo = ProductFeature::whereId($id)->first();
        }
        return view('backend.web-setting.feature-setting', compact('all_features', 'all_card_features', 'categories', 'featureSettingInfo', 'featureInfo'));
    }
}