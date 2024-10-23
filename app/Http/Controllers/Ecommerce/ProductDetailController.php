<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($name, $sellerSku = null)
    {
        $user_id = auth()?->user()->id ?? null;

        // Eager load relations: productColors, productVariations and productVariationAttributes
        $product_detail = Product::with([
            'productColors',
            'productVariations.productVariationAttributes.attributeValue'
        ])->whereName($name)
            ->when(!is_null($sellerSku), function ($query) use ($sellerSku) {
                return $query->where('seller_sku', $sellerSku);
            })
            ->first();

        // Group variations by color and size
        $colorToSizesMap = $product_detail->productColors->mapWithKeys(function ($color) {
            return [
                $color->id => $color->productVariations->flatMap(function ($variation) {
                    return $variation->productVariationAttributes->where('attributeValue.attribute.name', 'Size')->pluck('attribute_value_id');
                }),
            ];
        });

        return view('ecommerce.product', compact('product_detail', 'user_id', 'colorToSizesMap'));
    }
}
