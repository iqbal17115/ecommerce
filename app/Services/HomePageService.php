<?php

namespace App\Services;

use App\Models\Backend\Product\ProductFeature;

class HomePageService
{
    public function getProductFeatures()
    {
        return ProductFeature::with(
            [
                'Category',
                'Product' => function ($query) {
                    $query->latest()              // order by created_at desc
                        ->take(10);             // limit to 10 products
                },
                'Product.ProductMainImage',
                'Product.productVariations',
                'Product.reviewSum'
            ]
        )->has('Product')->whereCardFeature(0)->whereTopMenu(0)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC');
    }
}
