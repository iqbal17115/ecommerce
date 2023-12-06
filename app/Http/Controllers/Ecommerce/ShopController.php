<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Product;
use App\Http\Resources\User\Shop\ShopProductDetailResource;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use BaseModel;

    /**
     * Search roduct
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchProduct(Request $request): JsonResponse
    {
        try {
            $query = Product::query();

            // Add additional filters based on the request
            if ($request->searchCriteria  != 'null') {
                $query->where(function ($query) use ($request) {
                    $query->where('name', 'like', '%' . urldecode($request->searchCriteria) . '%');
                });
            }

            // Handle category_name-based filtering
            if ($request->categoryName != 'null') {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('name', urldecode($request->categoryName));
                });
            }

            // Filter based on min_price and max_price
            if ($request->min_price && $request->max_price) {
                $minPrice = $request->min_price ?: 0;
                $maxPrice = $request->max_price ?: PHP_FLOAT_MAX;
                $currentDate = date('Y-m-d');

                $query->filterByPriceRange($minPrice, $maxPrice, $currentDate);
            }

            if ($request->filled('selectedBrandIds')) {
                $selectedBrandIds = $request->selectedBrandIds;

                $query->whereIn('brand_id', explode(",", $selectedBrandIds));
            }

            $query->when($request->filled('orderOfProduct'), function ($query) use ($request) {
                $orderByOptions = [
                    2 => ['your_price', 'asc'],
                    3 => ['your_price', 'desc'],
                ];

                $orderBy = $request->orderOfProduct;

                // Apply sorting based on the mapping array
                $query->orderBy(...$orderByOptions[$orderBy] ?? []);
            });
            // Add more filters as needed
            $lists = $this->getLists($query, [], ShopProductDetailResource::class);

            // Return a success message with the data
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }
    public function shopSearch(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')->paginate(12);
        $brands = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->where('products.name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')
            ->orderBy('products.id', 'desc')
            ->select('brands.id', 'brands.name')
            ->distinct('brands.name')
            ->get();
        $related_category = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->where('products.name', 'like', '%' . $request->q . '%')->orderBy('id', 'desc')
            ->orderBy('products.id', 'desc')
            ->select('categories.id', 'categories.name')
            ->distinct('categories.name')
            ->first();

        $filter_type = 2;
        $filter_for = $request->q;
        return view('ecommerce.shop', compact(['products', 'filter_type', 'filter_for', 'brands', 'related_category']));
    }
    public function productOrderBy(Request $request)
    {

        // Assuming $request object contains the following parameters:
        // $request->order, $request->filter_type, $request->filter_for, $request->count

        $query = Product::query();

        switch ($request->order) {
            case 1:
                $query->latest();
                break;
            case 2:
                $query->orderBy('sale_price', 'asc');
                break;
            case 3:
                $query->orderBy('sale_price', 'desc');
                break;
        }
        $query->join('categories', 'categories.id', '=', 'products.category_id');
        if ($request->filter_type == 1 && !$request->category_id) {
            $query->where('categories.name', $request->filter_for);
        } else if ($request->filter_type == 2) {
            $query->where('products.name', 'like', '%' . $request->filter_for . '%');
        }

        if ($request->brand_id) {
            $query->whereIn('brand_id', [$request->brand_id]);
        }

        if ($request->category_id) {
            $query->whereIn('category_id', [$request->category_id]);
        }

        if ($request->min_price && $request->max_price) {

            $query->whereBetween('sale_price', [$request->min_price, $request->max_price]);
        }
        $query->select('products.*');
        $products = $query->paginate($request->count);

        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shopPaginationTotal(Request $request)
    {
        if ($request->filter_type == 1) {
            $products = Product::whereCategoryId($request->filter_for)->latest()->paginate($request->count);
        }
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shopPagination(Request $request)
    {
        $products = Product::latest()->paginate($request->count);
        return view('ecommerce.paginate-shop', compact('products'))->render();
    }
    public function shop(Request $request)
    {
        $searchCriteria = $request->input('q', '');
        $categoryName = $request->category_name;
        $query = Product::query();

        // Add additional filters based on the request
        if ($searchCriteria) {
            $query->where(function ($query) use ($searchCriteria) {
                $query->where('name', 'like', '%' . urldecode($searchCriteria) . '%');
            });
        }

        // Handle category_name-based filtering
        if ($categoryName) {
            $query->whereHas('category', function ($query) use ($categoryName) {
                $query->where('name', urldecode($categoryName));
            });
        }

        // Add more filters as needed

        $products = $this->getAllLists($query, [], ShopProductDetailResource::class);

        $brands = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->orderBy('products.id', 'desc')
            ->select('brands.id', 'brands.name')
            ->distinct('brands.name')
            ->get();

        $user_id = auth()->user()->id ?? null;
        $categories = Category::where('parent_category_id', null)->get();
        $category = null;
        // Pass the search criteria, category, and categories to the view
        return view('ecommerce.shop', compact(['products', 'brands', 'categories', 'user_id', 'searchCriteria', 'categoryName', 'category']));
    }
}
