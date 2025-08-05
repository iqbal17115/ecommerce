<?php

namespace App\Services;

use App\Models\Backend\Product\ProductFeature;

class HomePageService
{
    public function getProductFeatures()
    {
        return ProductFeature::with('Category', 'Product', 'Product.ProductMainImage', 'Product.productVariations', 'Product.reviewSum')->has('Product')->whereCardFeature(0)->whereTopMenu(0)->whereIsActive(1)->limit(5)->orderByRaw('ISNULL(position), position ASC');
    }
}
