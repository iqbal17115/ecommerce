<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Services\ProductVariationService;
use Illuminate\Http\Request;

class ProductVariationController extends Controller
{
    protected $productVariationService;

    public function __construct(ProductVariationService $productVariationService)
    {
        $this->productVariationService = $productVariationService;
    }

    public function storeVariations(Request $request)
    {
        $this->productVariationService->storeVariations($request->all());

        return response()->json([
            'status' => 201
        ]);
    }
}
