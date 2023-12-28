<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($name) {
        // Url decode
        $user_id = auth()?->user()->id ?? null;
        $product_detail = Product::whereName($name)->first();
        return view('ecommerce.product', compact(['product_detail', 'user_id']));
    }
}
