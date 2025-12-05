<?php

namespace App\Services;

use App\Models\Product;

class HomePageService
{
    public function getProduct()
    {
        return Product::with(['productCombinations', 'productCombinations.combinationOptionPivots', 'brand', 'category', 'media']);
    }
}
