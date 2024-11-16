<?php

namespace App\Services;

use App\Enums\MediaTypeEnums;
use App\Models\Media;
use App\Models\ProductColor;
use App\Models\ProductVariation;
use App\Models\ProductVariationAttribute;
use Illuminate\Support\Facades\DB;

class ProductVariationService
{
    public function storeOrUpdateVariations(array $data)
    {
        DB::transaction(function () use ($data) {
            $productId = $data['product_id'];

            // Fetch existing variations for the product to manage updates and deletions
            $existingVariations = ProductVariation::where('product_id', $productId)->get();

            // Track existing variations by color and size combinations for efficient lookups
            $existingMap = $existingVariations->mapWithKeys(function ($variation) {
                return [$variation->color_id . '_' . $variation->size_id => $variation];
            });

            // Collect IDs of variations to keep for deletion tracking
            $variationsToKeep = [];

            // Iterate over each color group
            foreach ($data['variations'] as $group) {
                $group = json_decode($group, true);
                $colorId = $group['color_id'];

                // Manage color record in product_colors table
                $productColor = ProductColor::firstOrCreate([
                    'product_id' => $productId,
                    'attribute_value_id' => $colorId,
                ]);

                // Handle image uploads for the color
                if (isset($data["color_images_{$colorId}"])) {
                    $this->storeOrUpdateColorImages($productColor, $data["color_images_{$colorId}"]);
                }

                // Iterate over variations within the color group
                foreach ($group['variations'] as $variation) {
                    $sizeId = $variation['size_id'];
                    $key = $colorId . '_' . $sizeId;

                    if (isset($existingMap[$key])) {
                        // Update existing variation
                        $existingVariation = $existingMap[$key];
                        $existingVariation->update([
                            'price' => $variation['price'],
                            'sku' => $variation['sku'] ?? null,
                            'stock' => $variation['stock']
                        ]);

                        // Update attributes (ensure color and size are up-to-date)
                        $this->updateVariationAttributes($existingVariation->id, $colorId, $sizeId);

                        // Keep track of this variation to avoid deletion
                        $variationsToKeep[] = $existingVariation->id;
                    } else {
                        // Store new variation
                        $newVariation = ProductVariation::create([
                            'product_id' => $productId,
                            'price' => $variation['price'],
                            'sku' => $variation['sku'] ?? null,
                            'stock' => $variation['stock'],
                            'color_id' => $colorId,
                            'size_id' => $sizeId
                        ]);

                        // Store attributes
                        $this->storeVariationAttributes($newVariation->id, $colorId, $sizeId);

                        // Keep track of this variation to avoid deletion
                        $variationsToKeep[] = $newVariation->id;
                    }
                }
            }

            // Delete variations that are no longer present in the request
            ProductVariation::where('product_id', $productId)
                ->whereNotIn('id', $variationsToKeep)
                ->delete();
        });
    }

    private function storeVariationAttributes($variationId, $colorId, $sizeId)
    {
        // Store color attribute
        ProductVariationAttribute::create([
            'product_variation_id' => $variationId,
            'attribute_value_id' => $colorId,
        ]);

        // Store size attribute
        ProductVariationAttribute::create([
            'product_variation_id' => $variationId,
            'attribute_value_id' => $sizeId,
        ]);
    }

    private function updateVariationAttributes($variationId, $colorId, $sizeId)
    {
        // Update or re-create color attribute
        ProductVariationAttribute::updateOrCreate(
            ['product_variation_id' => $variationId, 'attribute_value_id' => $colorId],
            ['attribute_value_id' => $colorId]
        );

        // Update or re-create size attribute
        ProductVariationAttribute::updateOrCreate(
            ['product_variation_id' => $variationId, 'attribute_value_id' => $sizeId],
            ['attribute_value_id' => $sizeId]
        );
    }

    private function storeOrUpdateColorImages($productColor, $files)
    {
        foreach ($files as $file) {
            $path = $file->store('color_images', 'public');
            Media::create([
                'mediable_id' => $productColor->id,
                'mediable_type' => ProductColor::class,
                'file_path' => $path,
                'mime_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'type' => MediaTypeEnums::PHOTO,
                'created_by' => auth()->id(),
            ]);
        }
    }
}
