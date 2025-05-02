<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\ProductVariationHelper;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Product;
use Illuminate\Http\Request;

class ProductDetailController extends Controller
{
    public function productDetail($name, $sellerSku = null)
    {
        $user_id = auth()?->user()->id ?? null;

        $product_detail = Product::with([
            'productColors',
            'productVariations.productVariationAttributes.attributeValue.attribute'
        ])->whereName($name)
            ->when(!is_null($sellerSku), fn($q) => $q->where('seller_sku', $sellerSku))
            ->firstOrFail();

        $variationMap = ProductVariationHelper::getProductVariationsGroupedByAttributes($product_detail->id);

        $attributeOptions = [];

        foreach ($variationMap as $variationId => $attributes) {
            foreach ($attributes as $attributeName => $value) {
                $attributeOptions[$attributeName][$value] = true; // use assoc to ensure uniqueness
            }
        }

        foreach ($attributeOptions as $attr => &$values) {
            $values = array_keys($values); // convert back to indexed array
        }
        return view('ecommerce.product', compact('product_detail', 'user_id', 'variationMap', 'attributeOptions'));
    }
}
