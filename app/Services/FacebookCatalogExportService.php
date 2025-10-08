<?php

namespace App\Services;

use App\Models\Backend\Product\Product;
use Illuminate\Support\Facades\Storage;

class FacebookCatalogExportService
{
    public function export(string $path = 'catalog/facebook_catalog.csv')
    {
        $file = fopen(storage_path("app/public/{$path}"), 'w');

        $headers = array_keys(config('facebook_catalog.columns'));
        fputcsv($file, $headers);


        Product::with(['Brand', 'Category', 'ProductMainImage'])
            ->chunk(200, function ($products) use ($file) {
                foreach ($products as $product) {
                    fputcsv($file, $this->mapProduct($product));
                }
            });

        fclose($file);
        return $path;
    }


    protected function mapProduct(Product $product): array
    {
        $columns = config('facebook_catalog.columns');
        $row = [];


        foreach ($columns as $col => $field) {
            $row[] = $this->resolveField($product, $field);
        }


        return $row;
    }


    protected function resolveField($product, $field)
    {
        $parts = explode('.', $field);
        $value = $product;

        foreach ($parts as $part) {
            if (is_null($value)) return '';

            if ($part === '*') {
                // If it's a collection, join urls
                if ($value instanceof \Illuminate\Support\Collection) {
                    return implode(',', $value->map(function ($img) {
                        return asset('storage/product_photo/' . $img->image);
                    })->toArray());
                }
                return '';
            }

            $value = $value->{$part} ?? '';
        }

        // handle image specially
        if ($field == 'images.0.url') {
            return asset('storage/product_photo/' . $product->ProductMainImage?->image);
        }

        // handle product link specially
        if ($field == 'product_link') {
            return route('products.details', [
                'name' => rawurlencode($product->name),
                'seller_sku' => $product->seller_sku,
            ]);
        }

        // format price
        if (str_contains($field, 'price') && $value) {
            $value = $value . ' BDT';
        }

        // format availability
        if ($field === 'is_active') {
            $value = $value ? 'in stock' : 'out of stock';
        }

        return $value;
    }
}
