<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function productOrderBy(Request $request) {
        if($request->order==1) {
            if($request->filter_type == 1) {
               $products = Product::whereCategoryId($request->filter_for)->latest()->paginate($request->count);
            }
        } else if($request->order==2) {
            if($request->filter_type == 1) {
               $products = Product::whereCategoryId($request->filter_for)->orderBy('sale_price', 'ASC')->paginate($request->count);
            }
        } else if($request->order==3) {
            if($request->filter_type == 1) {
               $products = Product::whereCategoryId($request->filter_for)->orderBy('sale_price', 'DESC')->paginate($request->count);
            }
        }
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shopPaginationTotal(Request $request) {
        if($request->filter_type == 1) {
            $products = Product::whereCategoryId($request->filter_for)->latest()->paginate($request->count);
        }
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shopPagination(Request $request) {
        $products = Product::latest()->paginate($request->count);        
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shop($id) {
        $products = Product::whereCategoryId($id)->orderBy('id', 'desc')->paginate(12);
        $filter_type = 1;
        $filter_for = $id;
        return view('ecommerce.shop', compact(['products', 'filter_type', 'filter_for']));
    }
}
