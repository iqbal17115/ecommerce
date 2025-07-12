<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\Home\HomeSliderResource;
use App\Http\Resources\User\Home\ProductFeature\HomePageProductFeatureResource;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\ProductFeature;
use App\Models\Backend\WebSetting\Slider;
use App\Services\CacheService;
use App\Services\HomePageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function __construct(private readonly HomePageService $homePageService, private readonly CacheService $cacheService) {}

    public function getMainContent()
    {
        $product_features = ProductFeature::whereCardFeature(0)->whereTopMenu(0)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC')->get();
        $top_features = ProductFeature::whereCardFeature(1)->whereTopMenu(1)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC')->get();
        $html = View::make('ecommerce.main-content', compact('product_features', 'top_features'))->render();

        return response()->json(['html' => $html]);
    }
    public function contactUs()
    {
        return view('ecommerce.contact');
    }
    public function addShippingAndDelivery()
    {
        return view('ecommerce.shipping-and-delivery');
    }
    public function privacyPolicy()
    {
        return view('ecommerce.privacy-policy');
    }
    public function termsAndCondition()
    {
        return view('ecommerce.terms-and-condition');
    }
    public function aboutUs()
    {
        return view('ecommerce.about');
    }
    public function getSidebarContent()
    {
        return view('ecommerce.sidebar-content')->render();
    }
    public function getParentCategory(Request $request)
    {
        if (isset($request->id[0]) && count($request->id[0]) > 0) {
            $categories = Category::with('SubCategory')->whereIN('id', $request->id[0])->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')->get();
        } else {
            $categories = Category::with('SubCategory')->whereSidebarMenu(1)->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')->get();
        }

        return response()->json(['categories' => $categories]);
    }
    public function checkSubCategory(Request $request)
    {
        $category = Category::find($request->id);
        if (count($category->SubCategory) > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function getSubCategory(Request $request)
    {
        $sub_categories = Category::with('SubCategory')->whereParentCategoryId($request->id)->orderBy('position', 'ASC')->get();
        return response()->json(['sub_categories' => $sub_categories]);
    }
    public function adminDashboard()
    {
        if (Auth::check() && Auth::user()->roles->where('is_admin', 1)->isNotEmpty()) {
            return view('backend.dashboard');
        } else {
            return redirect()->route('home');
        }
    }
    public function index()
    {
        $user_id = auth()?->user()->id ?? null;

        $sliders = $this->cacheService->remember('home_sliders', function () {
            return HomeSliderResource::collection(Slider::whereIsActive(1)->get());
        }, 300); // cache 5 mins
dd(1);
        $top_show_categories = Category::whereTopMenu(1)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC')->get();
        dd(2);
        $product_features = ProductFeature::getAllLists($this->homePageService->getProductFeatures(), [], HomePageProductFeatureResource::class);
        $top_features = ProductFeature::with('TopFeatureSetting', 'TopFeatureSetting.FeatureSettingDetail', 'TopFeatureSetting.FeatureSettingDetail.Category', 'TopFeatureSetting.ProductFeature', 'TopFeatureSetting.ProductFeature.Advertisement', 'Product')->whereCardFeature(1)->whereTopMenu(1)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC')->get();
        return view('ecommerce.home', compact(['sliders', 'top_show_categories', 'product_features', 'top_features', 'user_id']));
    }
}
