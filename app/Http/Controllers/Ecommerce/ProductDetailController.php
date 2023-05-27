<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($name) {
        // Url decode
        $decodedName = urldecode($name);
        $product_detail = Product::whereName($decodedName)->first();
        return view('ecommerce.product', compact(['product_detail']));
    }
}
