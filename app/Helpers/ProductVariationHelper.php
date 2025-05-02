<?php

namespace App\Helpers;

use App\Models\ProductVariation;

class ProductVariationHelper
{
    public static function getProductVariationsGroupedByAttributes($productId)
    {
        $variations = ProductVariation::with([
            'productVariationAttributes.attributeValue.attribute'
        ])->where('product_id', $productId)->get();

        $grouped = [];

        foreach ($variations as $variation) {
            $attributes = [];
            foreach ($variation->productVariationAttributes as $va) {
                if ($va->attributeValue && $va->attributeValue->attribute) {
                    $attrName = $va->attributeValue->attribute->name;
                    $attrValue = $va->attributeValue->value;
                    $attributes[$attrName] = $attrValue;
                }
            }
            $grouped[$variation->id] = $attributes;
        }

        return $grouped;
    }
}
