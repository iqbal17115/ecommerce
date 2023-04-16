<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Backend\Product\ProductFeature;
use Illuminate\Http\Request;

class ProductFeatureController extends Controller
{
    public function getFeature() {
        $product_features = ProductFeature::whereIsActive(1)->orderBy('position', 'DESC')->select('id', 'name')->get();
        return response()->json(['product_features' => $product_features]);
    }
    public function searchProductFeature(Request $request) {
        $product_features = ProductFeature::where('name', 'like', '%'.$request->search_string.'%')->orderBy('position', 'asc')->paginate(10);
        if($product_features->count() >= 1) {
        return view('backend.product.pagination-product-feature', compact('product_features'))->render();
        }else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request) {
        $product_features = ProductFeature::latest()->paginate(10);
        return view('backend.product.pagination-product-feature', compact('product_features'))->render();
    }
    public function deleteProductFeature(Request $request) {
        $product_feature = ProductFeature::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addProductFeature(Request $request) {
        $request->validate(
            [
                'name' => 'required|max:100',
                'card_feature' => 'required',
                'top_menu' => 'required',
                'position' => 'required',
                'is_active' => 'required',
            ],
            [
                'name' => 'Name is required',
                'card_feature' => 'Card Feature is required',
                'top_menu' => 'Top Menu is required',
                'position' => 'Position is required',
                'is_active' => 'Status is required',
            ]
        );
        if($request->cu_id > 0) {
            $product_feature = ProductFeature::find($request->cu_id);
        }else {
            $product_feature = new ProductFeature();
        }
        
        $product_feature->name = $request->name;
        $product_feature->card_feature = $request->card_feature;
        $product_feature->top_menu = $request->top_menu;
        $product_feature->position = $request->position;
        $product_feature->is_active = $request->is_active;
        $product_feature->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $product_features = ProductFeature::orderBy('id', 'desc')->paginate(10);
        $all_product_feature = ProductFeature::orderBy('id', 'desc')->get();
        return view('backend.product.product-feature', compact('product_features'));
    }
}
