<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($id) {
        $product_detail = Product::find($id);  
        return view('ecommerce.product', compact(['product_detail']));
    }
}
