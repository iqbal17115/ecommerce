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
                'name' => 'required|max:20',
                // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'is_active' => 'required',
            ],
            [
                'name' => 'Name is required',
                'image' => 'Image is required',
                'is_active' => 'Status is required',
            ]
        );
        if($request->cu_id > 0) {
            $category = Category::find($request->cu_id);
        }else {
            $category = new Category();
            $category->user_id = Auth::user()->id;
        }
        
        $category->name = $request->name;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
        }
        $image = $request->file('image')->store('images/blog_posts', 'public');
        $category->image = $image;
        $category->website = $request->website;
        $category->branch_id = 1;
        $category->is_active = $request->is_active;
        $category->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $categories = Category::latest()->paginate(10);
        return view('backend.product.category', compact('categories'));
    }
}
