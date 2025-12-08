<?php

namespace App\Services;

use App\Models\Backend\Product\ProductFeature;
use App\Models\Product;

class HomePageService
{
    public function getProduct()
    {
        return ProductFeature::has('products', '>=', 6);
    }
}
