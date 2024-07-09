<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;

class AttributeValueController extends Controller
{
    public function categoryHierarchy(Request $request)
    {
        $category = Category::with('Parent')->find($request->id);
        $child_categories = Category::whereParentCategoryId($request->id)->select('name')->get();
        return response()->json([
            'category' => $category,
            'child_categories' => $child_categories
        ]);
    }
    public function searchCategory(Request $request)
    {
        $categories = Category::where('name', 'like', '%' . $request->search_string . '%')->orderBy('id', 'desc')->paginate(10);
        if ($categories->count() >= 1) {
            return view('backend.product.pagination-category', compact('categories'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request)
    {
        $categories = Category::latest()->paginate(10);
        return view('backend.product.pagination-category', compact('categories'))->render();
    }
    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addAttributeValue(Request $request)
    {
        $request->validate(
            [
                'attribute_id' => 'required',
                'value' => 'required|max:50',
            ],
            [
                'attribute_id' => 'Attribute is required',
                'value' => 'Value is required',
            ]
        );

        if ($request->cu_id > 0) {
            $attributeValue = AttributeValue::find($request->cu_id);
        } else {
            $attributeValue = new AttributeValue();
        }

        $attributeValue->attribute_id = $request->attribute_id;
        $attributeValue->value = $request->value;
        $attributeValue->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $attributeValues = AttributeValue::with('attribute')->latest()->paginate(10);
        $attributes = Attribute::get();
        return view('backend.attribute_value.index', compact('attributeValues', 'attributes'));
    }
}
