<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Material;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function searchMaterial(Request $request) {
        $materials = Material::where('name', 'like', '%'.$request->search_string.'%')->orderBy('id', 'desc')->paginate(5);
        if($materials->count() >= 1) {
        return view('backend.product.pagination-material', compact('materials'))->render();
        }else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request) {
        $materials = Material::latest()->paginate(5);
        return view('backend.product.pagination-material', compact('materials'))->render();
    }
    public function deleteMaterial(Request $request) {
        $material = Material::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addMaterial(Request $request) {
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
            $material = Material::find($request->cu_id);
        }else {
            $material = new Material();
            $material->user_id = Auth::user()->id;
        }
        
        $material->name = $request->name;
        $material->branch_id = 1;
       
        $material->is_active = $request->is_active;
        $material->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $materials = Material::latest()->paginate(5);
        return view('backend.product.material', compact('materials'));
    }
}
