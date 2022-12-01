<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Brand;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function searchBrand(Request $request) {
        $brands = Brand::where('name', 'like', '%'.$request->search_string.'%')->orderBy('id', 'desc')->paginate(10);
        if($brands->count() >= 1) {
        return view('backend.product.pagination-brand', compact('brands'))->render();
        }else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request) {
        $brands = Brand::latest()->paginate(10);
        return view('backend.product.pagination-brand', compact('brands'))->render();
    }
    public function deleteBrand(Request $request) {
        $brand = Brand::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addBrand(Request $request) {
        $request->validate(
            [
                'name' => 'required|max:20',
                'is_active' => 'required',
            ],
            [
                'name' => 'Name is required',
                'is_active' => 'Status is required',
            ]
        );
        if($request->cu_id > 0) {
            $brand = Brand::find($request->cu_id);
        }else {
            $request->validate(
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
                [
                    'image' => 'Image is required',
                ]
            );
            $brand = new Brand();
            $brand->user_id = Auth::user()->id;
        }
        
        $brand->name = $request->name;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $image = $request->file('image')->store('images/blog_posts', 'public');
            $brand->image = $image;
        }
        
        $brand->website = $request->website;
        $brand->branch_id = 1;
        $brand->is_active = $request->is_active;
        $brand->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $brands = Brand::latest()->paginate(10);
        return view('backend.product.brand', compact('brands'));
    }
}