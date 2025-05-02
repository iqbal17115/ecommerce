<?php

namespace App\Helpers;

use App\Models\ProductVariation;

class ProductVariationHelper
{
    public static function getProductVariationsGroupedByAttributes($productId)
    {
        $variations = ProductVariation::with([
            'productVariationAttributes.attributeValue.attribute'
        ])
            ->where('product_id', $productId)
            ->get();

        $grouped = [];

        foreach ($variations as $variation) {
            $attributeMap = $variation->productVariationAttributes
                ->filter(fn($va) => $va->attributeValue && $va->attributeValue->attribute)
                ->mapWithKeys(function ($va) {
                    return [
                        $va->attributeValue->attribute->name => $va->attributeValue->value
                    ];
                })
                ->toArray();

            $grouped[$variation->id] = $attributeMap;
        }

        return $grouped;
    }
}
