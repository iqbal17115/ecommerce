<?php

namespace App\Services;

use App\Models\ProductVariation;
use App\Models\VariationAttributeValue;
use Illuminate\Support\Facades\DB;

class ProductVariationService
{
    public function storeVariations($product, array $data)
    {
        DB::transaction(function () use ($product, $data) {
            foreach ($data['variations'] as $variationKey => $variationData) {
                $productVariation = ProductVariation::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'price' => $variationData['price']
                    ],
                    [
                        'price' => $variationData['price']
                    ]
                );

                if($variationData['attribute_values']) {
                foreach ($variationData['attribute_values'] as $attrKey => $attributeIds) {
                    if (is_array($attributeIds) || is_object($attributeIds)) {
                        foreach ($attributeIds as $key => $attributeId) {
                            if ($key != 'stock' && $attributeId) {
                                VariationAttributeValue::updateOrCreate(
                                    [
                                        'product_variation_id' => $productVariation->id,
                                        'attribute_value_id' => $attributeId,
                                        'group_number' => isset($data['groups'][$attrKey][0]) ? $data['groups'][$attrKey][0] : $attrKey
                                    ],
                                    [
                                        'attribute_value_id' => $attributeId,
                                        'group_number' => isset($data['groups'][$attrKey][0]) ? $data['groups'][$attrKey][0] : $attrKey,
                                        'stock' => $attributeIds['stock']
                                    ]
                                );
                            }
                        }
                    }
                }
            }
            }
        });
    }
}
