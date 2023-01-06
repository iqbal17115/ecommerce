<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\Material;
use App\Models\Backend\Product\Condition;
use App\Models\Backend\Product\Product;
use App\Models\Backend\Product\ProductDetail;
use App\Models\Backend\Product\ProductImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProductImageInfo(Request $request)
    {

        foreach ($request->product_image as $product_image) {
            $Query = new ProductImage();
            $path = $product_image->store('/public/product_photo');
            $Query->image = basename($path);
            $Query->product_id = $request->product_image_id;
            $Query->save();
        }
        // $request->product_image
        return response()->json(['status' => 201]);
    }
    public function addProductDetailInfo(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $Query = Product::find($request->product_offer_id);

            $Query->your_price = $request->your_price;
            $Query->sale_price = $request->sale_price;
            $Query->retail_price = $request->retail_price;
            $Query->max_order_qty = $request->max_order_qty;
            $Query->sale_start_date = $request->sale_start_date;
            $Query->sale_end_date = $request->sale_end_date;
            $Query->start_selling_date = $request->start_selling_date;
            $Query->offering_gift_message = $request->offering_gift_message;
            $Query->gift_wrap_available = $request->gift_wrap_available;
            $Query->save();

            $ProductDetailQuery = ProductDetail::whereProductId($Query->product_offer_id)->first();
            if ($ProductDetailQuery) {
                $ProductDetailQuery->seller_sku = $request->seller_sku;
                $ProductDetailQuery->tax_code = $request->tax_code;
                $ProductDetailQuery->condition_id = $request->condition_id;
                $ProductDetailQuery->condition_note = $request->condition_note;
                $ProductDetailQuery->save();
            }

            return response()->json(['product_id' => $Query->id, 'status' => 201]);
        });
    }
    public function addVitalInfo(Request $request)
    {
        return DB::transaction(function () use ($request) {
            if ($request->vital_info_id == -1) {
                $Query = new Product();
                $Query->branch_id = 1;
                $Query->created_by = Auth::user()->id;
            } else {
                $Query = Product::find($request->vital_info_id);
            }

            $Query->code = $request->code;
            $Query->name = $request->name;
            $Query->type = $request->type;
            $Query->category_id = $request->category_id;
            $Query->brand_id = $request->brand_id;
            $Query->model_number = $request->model_number;
            $Query->model_name = $request->model_name;
            $Query->booking_date = $request->booking_date;
            $Query->save();

            $ProductDetailQuery = ProductDetail::whereProductId($Query->id)->first();
            if (!$ProductDetailQuery) {
                $ProductDetailQuery = new ProductDetail();
                $ProductDetailQuery->product_id = $Query->id;
                $ProductDetailQuery->outer_material = $request->outer_material;
                $ProductDetailQuery->material_type_id = $request->material_type_id;
            } else {
                $ProductDetailQuery->outer_material = $request->outer_material;
                $ProductDetailQuery->material_type_id = $request->material_type_id;
            }
            $ProductDetailQuery->save();

            return response()->json(['product_id' => $Query->id, 'status' => 201]);
        });
    }
    public function getCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
    public function index()
    {
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $materials = Material::orderBy('id', 'DESC')->get();
        $conditions = Condition::orderBy('id', 'DESC')->get();
        return view('backend.product.product', compact('categories', 'brands', 'materials', 'conditions'));
    }
}
