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
use Illuminate\Support\Facades\Crypt;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\ProductFeature;
use App\Services\UnitConversionService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $unitConversionService;

    public function __construct(UnitConversionService $unitConversionService)
    {
        $this->unitConversionService = $unitConversionService;
    }
    public function deleteProduct(Request $request)
    {
        return DB::transaction(function () use ($request) {
            Product::find($request->id)->delete();
            ProductImage::whereProductId($request->id)->delete();
            ProductDetail::whereProductId($request->id)->delete();
            ProductKeyword::whereProductId($request->id)->delete();
            ProductCompliance::whereProductId($request->id)->delete();
            ProductMoreDetail::whereProductId($request->id)->delete();

            return response()->json(['status' => 201]);
        });
    }
    public function searchProduct(Request $request)
    {
        $products = Product::where('name', 'like', '%' . $request->search_string . '%')->orderBy('id', 'desc')->paginate(20);
        if ($products->count() >= 1) {
            return view('backend.product.pagination-product', compact('products'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request)
    {
        $products = Product::latest()->paginate(20);
        return view('backend.product.pagination-product', compact('products'))->render();
    }
    public function productList()
    {
        $products = Product::latest()->paginate(20);
        return view('backend.product.product_list', compact('products'));
    }
    public function addProductVariantInfo(Request $request)
    {
        $variation = array();
        array_push($variation, explode(',', $request->selected_variation[0]));
        $selected_variations = explode(',', $request->selected_variation[0]);
        foreach ($selected_variations as $selected_variation) {
            if ($selected_variation == 1) {
                array_push($variation, $request->input_size);
                // array_push($variation, $request->input_bottom_size);
                // array_push($variation, $request->input_bottom_size_map);
            } else if ($selected_variation == 2) {
                array_push($variation, $request->input_color);
                // array_push($variation, $request->input_color_map);
            } else if ($selected_variation == 3) {
                array_push($variation, $request->input_package_qty);
            } else if ($selected_variation == 4) {
                array_push($variation, $request->input_material_type);
            } else if ($selected_variation == 5) {
                array_push($variation, $request->input_wattage);
            } else if ($selected_variation == 6) {
                array_push($variation, $request->input_number_of_item);
            } else if ($selected_variation == 7) {
                array_push($variation, $request->input_style_name);
            }
        }
        array_push($variation, $request->input_target_gender);
        array_push($variation, $request->input_description);
        array_push($variation, $request->input_seller_sku);
        array_push($variation, $request->input_product_code);
        array_push($variation, $request->input_type);
        array_push($variation, $request->input_your_price);
        array_push($variation, $request->input_quantity);

        $variation = json_encode($variation, JSON_FORCE_OBJECT);
        $Query = Product::find($request->product_variant_info_id);
        $Query->variation = $variation;
        $Query->save();

        return response()->json(['status' => 201, 'product_id' => $variation]);
    }
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
        $Query->package_height = $this->unitConversionService->convertLengthTo($request->package_height, $request->package_height_unit, 'm');
        $Query->package_height_unit = $request->package_height_unit;
        $Query->package_length = $this->unitConversionService->convertLengthTo($request->package_length, $request->package_length_unit, 'm');
        $Query->package_length_unit = $request->package_length_unit;
        $Query->package_width = $this->unitConversionService->convertLengthTo($request->package_width, $request->package_width_unit, 'm');
        $Query->package_width_unit = $request->package_width_unit;
        $Query->package_weight = $this->unitConversionService->convertWeightTo($request->package_weight, $request->package_weight_unit, 'gm');
        $Query->package_weight_unit = $request->package_weight_unit;
        $Query->league_name = $request->league_name;
        $Query->warranty = $request->warranty;
        $Query->warranty_unit = $request->warranty_unit;
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
        $Query = ProductMoreDetail::whereProductId($request->product_keyword_id)->first();
        if (!$Query) {
            $Query = new ProductMoreDetail();
        } 
            $Query->product_keyword = $request->keyword;
            $Query->product_id = $request->product_keyword_id;
            $Query->save();
        // $request->product_image
        return response()->json(['status' => 201]);
    }
    public function addProductDescriptionInfo(Request $request)
    {
        $Query = ProductDetail::whereProductId($request->product_description_id)->first();
        $Query->short_deacription = $request->short_deacription;
        $Query->description = $request->product_description;
        $Query->product_content = $request->product_content;
        $Query->save();
        return response()->json(['status' => 201]);
    }
    public function addProductImageInfo(Request $request)
    {
        if (is_array($request->product_image)) {
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
    }
        // $request->product_image
        return response()->json(['status' => 201]);
    }
    public function addProductDetailInfo(Request $request)
    {
        return DB::transaction(function () use ($request) {

            $Query = Product::whereId($request->product_offer_id)->first();

            $Query->seller_sku = $request->seller_sku;
            $Query->opening_qty = $request->opening_qty;
            $Query->quantity_unit = $request->quantity_unit;
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

            $ProductDetailQuery = ProductDetail::whereProductId($Query->product_offer_id)->firstOrNew();
            if ($ProductDetailQuery) {
                $ProductDetailQuery->tax_code = $request->tax_code;
                $ProductDetailQuery->material_type_id = $request->material_type_id;
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
                $Query = Product::whereId($request->vital_info_id)->first();
            }

            $Query->product_feature_id = $request->product_feature_id;
            $Query->model_number = $request->model_number;
            $Query->model_name = $request->model_name;
            $Query->booking_date = $request->booking_date;
            $Query->save();

            $ProductDetailQuery = ProductDetail::whereProductId($Query->id)->firstOrNew();
            $ProductDetailQuery->product_id = $Query->id;
            $ProductDetailQuery->outer_material = $request->outer_material;
            $ProductDetailQuery->material_type_id = $request->material_type_id;
            $ProductDetailQuery->condition_id = $request->condition_id;
            $ProductDetailQuery->condition_note = $request->condition_note;
            $ProductDetailQuery->outer_material = $request->outer_material;
            $ProductDetailQuery->save();

            return response()->json(['product_id' => $Query->id, 'status' => 201]);
        });
    }
    public function addProductIdentity(Request $request)
    {
        if ($request->product_identity_id == -1) {
            $Query = new Product();
            $Query->branch_id = 1;
            $Query->created_by = Auth::user()->id;
        } else {
            $Query = Product::whereId($request->product_identity_id)->first();
        }

        $Query->code = $request->code;
        $Query->name = $request->name;
        $Query->category_id = $request->category_id;
        $Query->type = $request->type;
        $Query->brand_available = $request->brand_available;
        $Query->brand_id = $request->brand_available == 1 ? $request->brand_id : null;
        $Query->save();

        return response()->json(['product_id' => $Query->id, 'status' => 201]);
    }
    public function getCategory($id)
    {
        $category = Category::find($id);
        return response()->json($category);
    }
    public function index(Request $request)
    {
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        $brands = Brand::orderBy('id', 'DESC')->get();
        $materials = Material::orderBy('id', 'DESC')->get();
        $conditions = Condition::orderBy('id', 'DESC')->get();
        $product_features = ProductFeature::orderBy('id', 'DESC')->whereIsActive(1)->get();
        $productInfo = null;
        $id = $request->id;
        if ($id) {
            $id = $id;
            $productInfo = Product::whereId($id)->first();
        }
        $unitConversionService = $this->unitConversionService;
        return view('backend.product.product', compact('categories', 'brands', 'materials', 'conditions', 'productInfo', 'product_features', 'unitConversionService'));
    }
}