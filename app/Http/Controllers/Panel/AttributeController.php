<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function searchAttribute(Request $request)
    {
        $attributes = Attribute::where('name', 'like', '%' . $request->search_string . '%')->orderBy('id', 'desc')->paginate(10);
        if ($attributes->count() >= 1) {
            return view('backend.attribute.pagination-attribute', compact('attributes'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request)
    {
        $attributes = Attribute::latest()->paginate(10);
        return view('backend.product.pagination-attribute', compact('attributes'))->render();
    }
    public function deleteAttribute(Request $request)
    {
        $attributes = Attribute::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addAttribute(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:20'
            ],
            [
                'name' => 'Name is required'
            ]
        );
        if ($request->cu_id > 0) {
            $attribute = Attribute::find($request->cu_id);
        } else {
            $attribute = new Attribute();
        }

        $attribute->name = $request->name;
        $attribute->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $attributes = Attribute::latest()->paginate(10);
        return view('backend.attribute.index', compact('attributes'));
    }

    public function getSizeValues()
    {
        $attribute = Attribute::with('values')
            ->where('name', 'Size')
            ->first();

        if (!$attribute) {
            return response()->json([
                'success' => false,
                'message' => 'Size attribute not found.'
            ], 404);
        }

        $sizes = $attribute->values->pluck('value')->toArray();

        return response()->json([
            'success' => true,
            'data' => $sizes
        ]);
    }

    public function getColorValues()
    {
        $attribute = Attribute::with('values')
            ->where('name', 'Color')
            ->first();

        if (!$attribute) {
            return response()->json([
                'success' => false,
                'message' => 'Color attribute not found.'
            ], 404);
        }

        $sizes = $attribute->values->pluck('value')->toArray();

        return response()->json([
            'success' => true,
            'data' => $sizes
        ]);
    }
}
