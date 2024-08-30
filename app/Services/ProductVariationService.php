<?php

namespace App\Services;

use App\Models\ProductVariation;
use App\Models\ProductVariationAttribute;
use Illuminate\Support\Facades\DB;

class ProductVariationService
{
    public function storeVariations(array $data)
    {
        // Validate the input data
        // $this->validateVariations($data);

        DB::transaction(function () use ($data) {
            $productId = $data['product_id'];

            foreach ($data['variations'] as $variation) {
                $variation = json_decode($variation, true);
                // Store the product variation
                $productVariation = ProductVariation::create([
                    'product_id' => $productId,
                    'price' => $variation['price'],
                    'sku' => $variation['sku'] ?? null,
                    'stock' => $variation['stock']
                ]);

                // Handle image upload
                // $this->handleImageUpload($variation['color_id'], $productVariation);

                // Store the variation attributes (color and size)
                foreach ($variation['attributes'] as $attributeValueId) {
                    ProductVariationAttribute::create([
                        'product_variation_id' => $productVariation->id,
                        'attribute_value_id' => $attributeValueId,
                    ]);
                }
            }
        });
    }

    /**
     * Validate the variations data.
     *
     * @param array $data
     * @throws ValidationException
     */
    protected function validateVariations(array $data)
    {
        $validator = \Validator::make($data, [
            'product_id' => 'required|exists:products,id',
            'variations.*.price' => 'required|numeric|min:0',
            'variations.*.sku' => 'nullable|string|max:255',
            'variations.*.stock' => 'required|integer|min:0',
            'variations.*.status' => 'nullable|boolean',
            'variations.*.attributes' => 'required|array',
            'variations.*.attributes.*' => 'exists:attribute_values,id',
            'variations.*.color_id' => 'nullable|exists:colors,id',
            // Add other rules as needed
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Handle image upload for product variation.
     *
     * @param int $colorId
     * @param ProductVariation $productVariation
     */
    protected function handleImageUpload($colorId, ProductVariation $productVariation)
    {
        $imageInputName = "color_img_$colorId";
        if (request()->hasFile($imageInputName)) {
            $file = request()->file($imageInputName);
            $filePath = $file->store('product-variations', 'public');

            // Optionally, you can store the file path in the product variation model
            $productVariation->update([
                'image_path' => $filePath
            ]);
        }
    }
}
