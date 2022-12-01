<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\Material;
use App\Models\Backend\Product\Variant;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $materials = Material::orderBy('id', 'DESC')->get();
        $variants = Variant::orderBy('id', 'DESC')->get();
        return view('backend.product.product', compact('categories', 'brands', 'materials', 'variants'));
    }
}