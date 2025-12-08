<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Helpers\ProductVariationHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Product\ProductListRequest;
use App\Http\Resources\User\Product\ProductListResource;
use Illuminate\Http\JsonResponse;

class ProductDetailController extends Controller
{
    /**
     * Index
     *
     * @param ProductListRequest $request
     * @return JsonResponse
     */
    public function index(ProductListRequest $request): JsonResponse
    {
        // Call the Service to get list data
        $lists = Product::getLists(Product::with([
            'productVariations',
            'ProductMainImage',
            'Brand',
            'ProductDetail',
        ])->withCount('reviews')             
            ->withAvg('reviews', 'rating')
        , $request->validated(), ProductListResource::class);

        // Return a success message with the data
        return Message::success(null, $lists);
    }

    public function productDetail($name, $sellerSku = null)
    {
        $user_id = auth()?->user()->id ?? null;

        $product_detail = Product::with([
            'productColors',
            'productColors.media',
            'productVariations.productVariationAttributes.attributeValue.attribute',
            'ProductMainImage',
            'ProductImage',
            'Brand',
            'ProductDetail',
            'ProductDetail.Condition',
        ])->withCount('reviews')              // review count for this product
            ->withAvg('reviews', 'rating')
            ->whereName($name)
            ->when(!is_null($sellerSku), fn($q) => $q->where('seller_sku', $sellerSku))
            ->firstOrFail();


        $variationMap = ProductVariationHelper::getProductVariationsGroupedByAttributes($product_detail->id);

        $attributeOptions = [];

        foreach ($variationMap as $variationId => $attributes) {
            foreach ($attributes as $attributeName => $value) {
                $attributeOptions[$attributeName][$value] = true; // use assoc to ensure uniqueness
            }
        }

        foreach ($attributeOptions as $attr => &$values) {
            $values = array_keys($values); // convert back to indexed array
        }

        return view('ecommerce.product', compact('product_detail', 'user_id', 'variationMap', 'attributeOptions'));
    }
}
