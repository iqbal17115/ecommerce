<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Variant;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function getVariantById($id) {
        $variant = Variant::find($id);

        return response()->json($variant);
    }
    public function getVariant($type)
    {
        if ($type == 1) {
            $variants = Variant::whereType('Size')->orderBy('id', 'desc')->get();
        } else if($type == 2) {
            $variants = Variant::whereType('Color')->orderBy('id', 'desc')->get();
        } else if ($type == 4) {
            $variants = Variant::whereType('Material_Type')->orderBy('id', 'desc')->get();
        }

        return response()->json($variants);
    }
    public function searchVariant(Request $request)
    {
        $variants = Variant::where('name', 'like', '%' . $request->search_string . '%')->orWhere('short_name', 'like', '%' . $request->search_string . '%')->orderBy('id', 'desc')->paginate(10);
        if ($variants->count() >= 1) {
            return view('backend.product.pagination-variant', compact('variants'))->render();
        } else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request)
    {
        $variants = Variant::latest()->paginate(10);
        return view('backend.product.pagination-variant', compact('variants'))->render();
    }
    public function deleteVariant(Request $request)
    {
        $variant = Variant::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addVariant(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:30',
                'type' => 'required|max:20',
                'is_active' => 'required',
            ],
            [
                'name' => 'Name is required',
                'type' => 'Type is required',
                'is_active' => 'required',
            ]
        );
        if ($request->cu_id > 0) {
            $variant = Variant::find($request->cu_id);
        } else {
            $variant = new Variant();
            $variant->user_id = Auth::user()->id;
        }

        $variant->name = $request->name;
        $variant->type = $request->type;
        if ($request->type == "Color") {
            $variant->color_code = $request->color_code;
        } else {
            $variant->color_code = "";
        }
        $variant->branch_id = 1;

        $variant->is_active = $request->is_active;
        $variant->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $variants = Variant::latest()->paginate(10);
        return view('backend.product.variant', compact('variants'));
    }
}
