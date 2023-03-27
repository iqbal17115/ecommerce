<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\ProductFeature;
use App\Models\Backend\WebSetting\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function getSidebarContent() {
        return view('ecommerce.sidebar-content')->render();
    }
    public function getParentCategory(Request $request) {
        if(isset($request->id[0]) && count($request->id[0]) > 0) {
            $categories = Category::with('SubCategory')->whereIN('id', $request->id[0])->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')->get();
        } else {
            $categories = Category::with('SubCategory')->whereSidebarMenu(1)->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')->get();
        }
        
        return response()->json(['categories' => $categories]);
    }
    public function checkSubCategory(Request $request) {
        $category = Category::find($request->id);
        if(count($category->SubCategory) > 0) {
            return 1;
        } else {
            return 0;
        }
        
    }
    public function getSubCategory(Request $request) {
        $sub_categories = Category::with('SubCategory')->whereParentCategoryId($request->id)->orderBy('position', 'ASC')->get();
        return response()->json(['sub_categories' => $sub_categories]);
    }
    public function adminDashboard() {
        return view('backend.dashboard');
    }
    public function index() {
        // dd(Auth::user());
        $sliders = Slider::whereIsActive(1)->get();
        $top_show_categories = Category::whereTopMenu(1)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC')->get();
        $product_features = ProductFeature::whereIsActive(1)->orderByRaw('ISNULL(position), position ASC')->get();
        return view('ecommerce.home', compact(['sliders', 'top_show_categories', 'product_features']));
    }
}
