<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelectListRequest;
use App\Http\Requests\ShopPage\ShopPageRequest;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Product;
use App\Http\Resources\User\Shop\ShopProductDetailResource;
use App\Models\Backend\Product\Brand;
use App\Models\AttributeValue;
use Exception;
use Illuminate\Http\JsonResponse;

class ShopController extends Controller
{
    /**
     * Search roduct
     *
     * @param ShopPageRequest $shopPageRequest
     * @return JsonResponse
     */
    public function list(SelectListRequest $selectListRequest): JsonResponse
    {
        try {
            // Add more filters as needed
            $lists = Product::getLists(Product::query(), $selectListRequest->validated(), ShopProductDetailResource::class);

            // Return a success message with the data
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    public function getSubcategories(Category $category)
    {
        $category->load('SubCategory'); // Load subcategories for the given category
        return view('ecommerce.partials.subcategories', compact('category'))->render();
    }


    public function shop()
    {
        return view('ecommerce.shop.index');
    }
}
