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
            $lists = Product::getAllLists(Product::query(), $selectListRequest->validated(), ShopProductDetailResource::class);

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


    public function shop(ShopPageRequest $shopPageRequest)
    {
        $searchCriteria = $shopPageRequest->input('search', '');
        if ($searchCriteria) {
            $searchCriteria = urldecode($shopPageRequest['search']);
        }

        // Query products based on the search term
        $productsQuery = Product::query();

        $categoryName = urldecode($shopPageRequest->category_name);

        if ($searchCriteria) {
            $productsQuery->where('name', 'like', '%' . $searchCriteria . '%')
                ->orWhereHas('ProductDetail', function ($query) use ($searchCriteria) {
                    $query->where('description', 'like', '%' . $searchCriteria . '%')
                        ->orWhere('description', 'like', '%' . $searchCriteria . '%');
                });
        }

        // Get the products that match the search term
        $products = $productsQuery->get();

        // 2. (Optional) Retrieve only the brands that are related to the searched products
        $filteredBrandIds = $products->pluck('brand_id')->unique();
        $brands = Brand::whereIn('id', $filteredBrandIds)->get();
        $user_id = auth()->user()->id ?? null;
        // Load categories with one level of subcategories initially
        $categories = Category::with(['SubCategory'])->where('parent_category_id', null)->get();

        $category = null;
        // Pass the search criteria, category, and categories to the view
        return view('ecommerce.shop.index', compact(['brands', 'categories', 'user_id', 'searchCriteria', 'categoryName', 'category']));
    }
}
