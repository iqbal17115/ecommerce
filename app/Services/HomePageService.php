<?php

namespace App\Services;

use App\Models\Backend\Product\ProductFeature;

class HomePageService
{
    public function getProductFeatures()
    {
        return ProductFeature::with(['Category', 
         'Product' => function ($query) {
            $query->whereIsActive(1) // optional
                  ->latest()        // order by created_at desc
                  ->take(8);        // limit to 8 products per feature
        },
        'Product.ProductMainImage', 'Product.productVariations', 'Product.reviewSum'])->whereCardFeature(0)->whereTopMenu(0)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC');
    }
}
