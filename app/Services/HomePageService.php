<?php

namespace App\Services;

use App\Models\Backend\Product\ProductFeature;

class HomePageService
{
    public function getProductFeatures()
    {
        return ProductFeature::with([
        'Category',
        'latestProducts' => function ($query) {
            $query->take(8); 
            $query->with(['ProductMainImage', 'productVariations', 'reviewSum']);
        }
    ])
        ->whereCardFeature(0)->whereTopMenu(0)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC');
    }
}
