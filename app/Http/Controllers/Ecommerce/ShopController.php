<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Product;
use App\Http\Resources\User\Shop\ShopProductDetailResource;
use App\Traits\BaseModel;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    use BaseModel;

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
    public function shop($name)
    {
        $name = urldecode($name);
        $products = $this->getAllLists(Product::whereHas('Category', function ($query) use ($name) {
            $query->where('name', $name);
        }), [], ShopProductDetailResource::class);
        $brands = Product::join('categories', 'categories.id', '=', 'products.category_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->orderBy('products.id', 'desc')
            ->select('brands.id', 'brands.name')
            ->distinct('brands.name')
            ->get();

            $related_category = Category::get();
        return view('ecommerce.shop', compact(['products', 'brands', 'related_category']));
    }
}
