<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Category;
use App\Models\Backend\WebSetting\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getSubCategory(Request $request) {
        $sub_categories = Category::whereParentCategoryId($request->id)->get(['id', 'name']);
        return response()->json(['sub_categories' => $sub_categories]);
    }
    public function adminDashboard() {
        return view('backend.dashboard');
    }
    public function index() {
        $sliders = Slider::whereIsActive(1)->get();
        $top_show_categories = Category::whereTopMenu(1)->whereIsActive(1)->get();
        return view('ecommerce.home', compact(['sliders', 'top_show_categories']));
    }
}
