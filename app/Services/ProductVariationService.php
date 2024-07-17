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
                        'price' => $variationData['price'],
                        'stock' => $variationData['stock']
                    ],
                    [
                        'price' => $variationData['price'],
                        'stock' => $variationData['stock']
                    ]
                );

                foreach ($variationData['attribute_values'] as $attrKey => $attributeIds) {
                    foreach ($attributeIds as $attributeId) {
                        VariationAttributeValue::updateOrCreate(
                            [
                                'product_variation_id' => $productVariation->id,
                                'attribute_value_id' => $attributeId,
                                'group_number' => isset($data['groups'][$attrKey][0]) ? $data['groups'][$attrKey][0] : $attrKey
                            ],
                            [
                                'attribute_value_id' => $attributeId,
                                'group_number' => isset($data['groups'][$attrKey][0]) ? $data['groups'][$attrKey][0] : $attrKey
                            ]
                        );
                    }
                }
            }
        });
    }
}
