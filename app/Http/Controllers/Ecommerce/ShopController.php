<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shopPaginationTotal(Request $request) {
        $products = Product::latest()->paginate($request->count);
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shopPagination(Request $request) {
        $products = Product::latest()->paginate($request->count);        
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shop($id) {
        $products = Product::whereCategoryId($id)->orderBy('id', 'desc')->paginate(12);
        return view('ecommerce.shop', compact(['products']));
    }
}
