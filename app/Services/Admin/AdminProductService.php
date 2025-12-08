<?php

namespace App\Services\Admin;

use App\Models\CombinationOptionPivot;
use App\Models\Product;
use App\Models\ProductCombination;
use App\Models\ProductSpec;
use App\Models\ProductVariant;
use App\Models\VariantOption;
use Illuminate\Support\Facades\DB;

class AdminProductService
{
    /**
     * Product List
     */
    public function getProductList($request)
    {
        $query = Product::query()
            ->with(['category', 'brand'])
            ->orderByDesc('created_at');

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return $query->paginate(20);
    }


    /**
     * Create Product
     */
    public function storeProduct($request): Product
    {
        return DB::transaction(function () use ($request) {

            $product = $this->createBaseProduct($request);

            // Media
            $this->saveMedia($product, $request);

            // Variants + Combinations
            $this->processVariantsAndCombinations($product, $request);

            // Product Specs
            $this->saveProductSpecs($product, $request);

            return $product;
        });
    }


    /**
     * Update Product
     */
    public function updateProduct(Product $product, $request): Product
    {
        return DB::transaction(function () use ($product, $request) {

            // 1. Update Base Product
            $this->updateBaseProduct($product, $request);

            // 2. Remove old variants & combinations
            $this->deleteOldVariantData($product);

            // 3. Save media (delete and re-upload)
            $this->updateMedia($product, $request);

            // 3. Recreate variants & combinations
            $this->processVariantsAndCombinations($product, $request);

            // 4. Update Product Specs (Upsert)
            $this->saveProductSpecs($product, $request);

            return $product;
        });
    }


    /**
     * Creates the core Product model.
     */
    private function createBaseProduct($req): Product
    {
        return Product::create([
            'name'               => $req['product_name'],
            'category_id'        => $req['category_id'],
            'brand_id'           => $req['brand_id'],
            'product_feature_id' => $req['product_feature_id'],
            'description'        => $req['description'],
            'short_description'  => $req['short_description'],
            'highlights'         => $req['highlights'],
            'status'             => 'draft',
        ]);
    }


    /**
     * Update base product
     */
    private function updateBaseProduct(Product $product, $req): void
    {
        $product->update([
            'name'               => $req['product_name'],
            'category_id'        => $req['category_id'],
            'brand_id'           => $req['brand_id'] ?? $product->brand_id,
            'product_feature_id' => $req['product_feature_id'],
            'description'        => $req['description'],
            'short_description'  => $req['short_description'],
            'highlights'         => $req['highlights'],
        ]);
    }


    /**
     * Delete old variants, options, combinations
     */
    private function deleteOldVariantData(Product $product): void
    {
        $product->productVariants()->each(function ($variant) {
            $variant->variantOptions()->delete();
        });

        $product->productVariants()->delete();
        $product->productCombinations()->delete();
    }


    /**
     * PROCESS VARIANTS, OPTIONS & COMBINATIONS (Store/Update)
     */
    private function processVariantsAndCombinations(Product $product, $request): void
    {
        $variantNames = collect([
            'variant_name_1' => $request['variant_name_1'],
            'variant_name_2' => $request['variant_name_2'],
        ])->filter();

        $variantMap = [];
        $optionMap = [];

        // Create variant rows
        foreach ($variantNames as $key => $name) {
            $variant = ProductVariant::create([
                'product_id' => $product->id,
                'name' => $name,
                'is_image_variant' => false,
                'sort_order' => ($key === 'variant_name_1' ? 1 : 2),
            ]);

            $variantMap[$name] = $variant->id;
        }

        $orderedVariantNames = array_values($variantNames->toArray());
        $combinationsData = $request['combinations'] ?? [];
        $sortOrders = [];

        // Create Options
        foreach ($combinationsData as $combination) {
            foreach ($combination['option_values'] ?? [] as $idx => $value) {

                if (!isset($orderedVariantNames[$idx])) continue;

                $variantName = $orderedVariantNames[$idx];
                $variantId = $variantMap[$variantName];

                $key = "$variantName|$value";

                if (!isset($sortOrders[$variantName])) {
                    $sortOrders[$variantName] = 1;
                }

                if (!isset($optionMap[$key])) {
                    $option = VariantOption::create([
                        'product_variant_id' => $variantId,
                        'option_value' => $value,
                        'sort_order' => $sortOrders[$variantName]++,
                    ]);

                    $optionMap[$key] = $option->id;
                }
            }
        }

        // Create Combinations
        foreach ($combinationsData as $idx => $row) {
            $comb = ProductCombination::create([
                'product_id'     => $product->id,
                'unique_key'     => $row['unique_key'] ?? $idx,
                'price'          => $row['price'] ?? 0,
                'special_price'  => $row['special_price'] ?? null,
                'stock'          => $row['stock'] ?? 0,
                'seller_sku'     => $row['seller_sku'] ?? null,
            ]);

            foreach ($row['option_values'] ?? [] as $i => $value) {

                if (!isset($orderedVariantNames[$i])) continue;

                $variantName = $orderedVariantNames[$i];
                $key = "$variantName|$value";

                if (isset($optionMap[$key])) {
                    CombinationOptionPivot::create([
                        'product_combination_id' => $comb->id,
                        'variant_option_id'       => $optionMap[$key],
                    ]);
                }
            }
        }
    }


    /**
     * UPSERT PRODUCT SPECS (Used for STORE + UPDATE)
     */
    private function saveProductSpecs(Product $product, $req): void
    {
        $specs = [
            'package_weight'   => $req['package_weight'],
            'weight_unit'      => $req['weight_unit'],
            'package_length'   => $req['length'],
            'package_width'    => $req['width'],
            'package_height'   => $req['height'],
            'dangerous_goods'  => $req['dangerous_goods'],
            'warranty_type'    => $req['warranty_type'],
            'warranty_period'  => $req['warranty'],
            'warranty_policy'  => $req['warranty_policy'],
        ];

        foreach ($specs as $name => $value) {

            if ($value === null || $value === '') continue;

            ProductSpec::updateOrCreate(
                ['product_id' => $product->id, 'attribute_name' => $name],
                ['value' => (string) $value]
            );
        }
    }

    private function saveMedia(Product $product, $req): void
    {
        // FEATURE IMAGE
        if (!empty($req['main_image'])) {

            $path = $req['main_image']->store('products', 'public');

            $product->media()->create([
                'type'       => 'feature',
                'path'       => $path,
                'sort_order' => 1,
            ]);
        }

        // PROMO IMAGE
        if (!empty($req['promo_image'])) {
            $promo = $product->media()->where('type', 'promo')->first();

            $path = $req['promo_image']->store('products/promo', 'public');

            if ($promo) {
                $promo->update(['path' => $path]);
            } else {
                $product->media()->create([
                    'type'       => 'promo',
                    'path'       => $path,
                    'sort_order' => 1,
                ]);
            }
        }

        // GALLERY IMAGES
        if (!empty($req['gallery_images'])) {
            $sort = 1;
            foreach ($req['gallery_images'] as $image) {
                if (!$image) continue;

                $path = $image->store('products/gallery', 'public');

                $product->media()->create([
                    'type'       => 'gallery',
                    'path'       => $path,
                    'sort_order' => $sort++,
                ]);
            }
        }
    }

    private function updateMedia(Product $product, $req): void
    {
        // Save new media
        $this->saveMedia($product, $req);
    }
}
