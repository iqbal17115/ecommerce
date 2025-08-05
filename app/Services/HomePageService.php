<?php

namespace App\Services;

use App\Models\Backend\Product\ProductFeature;

class HomePageService
{
    public function getProductFeatures()
    {
        return ProductFeature::with('Category', 'limitedProducts', 'limitedProducts.ProductMainImage', 'limitedProducts.productVariations', 'limitedProducts.reviewSum')->has('Product')->whereCardFeature(0)->whereTopMenu(0)->whereIsActive(1)->orderByRaw('ISNULL(position), position ASC');
    }
}
