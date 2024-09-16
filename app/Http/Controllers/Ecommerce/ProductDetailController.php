<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($name)
    {
        // Url decode
        $user_id = auth()?->user()->id ?? null;
        $product_detail = Product::with('productColors', 'productVariations', 'productVariations.productVariationAttributes')->whereName($name)->first();
        // Extract unique size attributes using higher-order collection methods
        $uniqueSizes = $product_detail->productVariations
            ->flatMap(function ($productVariation) {
                return $productVariation->productVariationAttributes->filter(function ($attribute) {
                    return $attribute->attributeValue->attribute->name === 'Size';
                })->pluck('attributeValue');
            })
            ->unique('id');

        return view('ecommerce.product', compact(['product_detail', 'uniqueSizes', 'user_id']));
    }
}
