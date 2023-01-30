<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function searchCategory(Request $request) {
        $categories = Category::where('name', 'like', '%'.$request->search_string.'%')->orderBy('id', 'desc')->paginate(10);
        if($categories->count() >= 1) {
        return view('backend.product.pagination-category', compact('categories'))->render();
        }else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request) {
        $categories = Category::latest()->paginate(10);
        return view('backend.product.pagination-category', compact('categories'))->render();
    }
    public function deleteCategory(Request $request) {
        $category = Category::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addCategory(Request $request) {
        $request->validate(
            [
                'name' => 'required|max:50',
                'is_active' => 'required',
            ],
            [
                'name' => 'Name is required',
                'is_active' => 'Status is required',
            ]
        );
        // dd($request->variation_type);
        if($request->cu_id > 0) {
            $category = Category::find($request->cu_id);
        }else {
            $request->validate(
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
                [
                    'image' => 'Image is required',
                ]
            );
            $category = new Category();
            $category->user_id = Auth::user()->id;
        }
        
        $category->name = $request->name;
        $category->parent_category_id = $request->id;
        $category->top_menu = $request->top_menu;
        $category->position = $request->position;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $image = $request->file('image')->store('category/images', 'public');
            $category->image = $image;
        }

        if ($request->file('icon')) {
            $iconPath = $request->file('icon');
            $iconName = $iconPath->getClientOriginalName();
            $path = $request->file('icon')->storeAs('uploads', $iconName, 'public');
            $icon = $request->file('icon')->store('category/icons', 'public');
            $category->icon = $icon;
        }

        $category->vendor_commission_percentage = $request->vendor_commission_percentage;
        $category->variation_type = json_encode($request->variation_type);
        $category->branch_id = 1;
        $category->is_active = $request->is_active;
        $category->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $categories = Category::latest()->paginate(10);
        $parent_categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        return view('backend.product.category', compact('categories', 'parent_categories'));
    }
}