<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\Material;
use App\Models\Backend\Product\Condition;
use App\Models\Backend\Product\Product;
use App\Models\Backend\Product\ProductDetail;
use App\Models\Backend\Product\ProductImage;
use App\Models\Backend\Product\ProductKeyword;
use App\Models\Backend\Product\ProductCompliance;
use App\Models\Backend\Product\ProductMoreDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function addProductMoreDetailInfo(Request $request)
    {
        $Query = ProductMoreDetail::whereProductId($request->product_more_detail_id)->first();
        if (!$Query) {
            $Query = new ProductMoreDetail();
        }
        $Query->closure_type = $request->closure_type;
        $Query->manufacturer = $request->manufacturer;
        $Query->manufacturer_part_number = $request->manufacturer_part_number;
        $Query->number_of_item = $request->number_of_item;
        $Query->release_date = $request->release_date;
        $Query->fabric_type = $request->fabric_type;
        $Query->item_length = $request->item_length;
        $Query->item_length_unit = $request->item_length_unit;
        $Query->item_width = $request->item_width;
        $Query->item_width_unit = $request->item_width_unit;
        $Query->item_height = $request->item_height;
        $Query->item_height_unit = $request->item_height_unit;
        $Query->package_height = $request->package_height;
        $Query->package_height_unit = $request->package_height_unit;
        $Query->package_length = $request->package_length;
        $Query->package_length_unit = $request->package_length_unit;
        $Query->package_width = $request->package_width;
        $Query->package_width_unit = $request->package_width_unit;
        $Query->package_weight = $request->package_weight;
        $Query->package_weight_unit = $request->package_weight_unit;
        $Query->league_name = $request->league_name;
        $Query->warranty_description = $request->warranty_description;
        $Query->team_name = $request->team_name;
        $Query->age_range_description = $request->age_range_description;
        $Query->lining_description = $request->lining_description;
        $Query->strap_type = $request->strap_type;
        $Query->handle_type = $request->handle_type;
        $Query->number_of_compartment = $request->number_of_compartment;
        $Query->number_of_wheel = $request->number_of_wheel;
        $Query->pocket_description = $request->pocket_description;
        $Query->sheel_type = $request->sheel_type;
        $Query->wheel_type = $request->wheel_type;
        $Query->product_id = $request->product_more_detail_id;
        $Query->save();
        return response()->json(['status' => 201]);
    }
    public function addProductComplianceInfo(Request $request)
    {
        $Query = ProductCompliance::whereProductId($request->product_compliance_id)->first();
        if (!$Query) {
            $Query = new ProductCompliance();
        }
        $Query->battery_cell_type = $request->battery_cell_type;
        $Query->battery_type = $request->battery_type;
        $Query->number_of_battery_require = $request->number_of_battery_require;
        $Query->lithium_battery_energy_content = $request->lithium_battery_energy_content;
        $Query->lithium_battery_energy_content_unit = $request->lithium_battery_energy_content_unit;
        $Query->lithium_battery_packaging = $request->lithium_battery_packaging;
        $Query->battery_include = $request->battery_include;
        $Query->battery_require = $request->battery_require;
        $Query->battery_weight = $request->battery_weight;
        $Query->battery_weight_unit = $request->battery_weight_unit;
        $Query->number_of_lithium_metal_cell = $request->number_of_lithium_metal_cell;
        $Query->number_of_lithium_ion_cell = $request->number_of_lithium_ion_cell;
        $Query->lithium_battery_weight = $request->lithium_battery_weight;
        $Query->lithium_battery_weight_unit = $request->lithium_battery_weight_unit;
        $Query->regulatory_id = $request->regulatory_id;
        $Query->safety_data_sheet_url = $request->safety_data_sheet_url;
        $Query->volume = $request->volume;
        $Query->volume_unit = $request->volume_unit;
        $Query->flash_point = $request->flash_point;
        $Query->item_weight = $request->item_weight;
        $Query->item_weight_unit = $request->item_weight_unit;
        $Query->product_id = $request->product_compliance_id;
        $Query->save();
        return response()->json(['status' => 201]);
    }
    public function addProductKeywordInfo(Request $request)
    {
        foreach ($request->keyword as $key => $keyword) {
            $Query = ProductKeyword::whereSerial($key)->whereProductId($request->product_keyword_id)->first();
            if (!$Query) {
                $Query = new ProductKeyword();
            }
            $Query->keyword = $keyword;
            $Query->serial = $key;
            $Query->product_id = $request->product_keyword_id;
            $Query->save();
        }
        // $request->product_image
        return response()->json(['status' => 201]);
    }
    public function addProductDescriptionInfo(Request $request)
    {
        $Query = ProductDetail::whereProductId($request->product_description_id)->first();
        $Query->description = $request->product_description;
        $Query->save();
        return response()->json(['status' => 201]);
    }
    public function addProductImageInfo(Request $request)
    {

        foreach ($request->product_image as $key => $product_image) {
            $Query = ProductImage::whereSerial($key)->whereProductId($request->product_image_id)->first();
            if (!$Query) {
                $Query = new ProductImage();
            }
            $path = $product_image->store('/public/product_photo');
            $Query->image = basename($path);
            $Query->serial = $key;
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
