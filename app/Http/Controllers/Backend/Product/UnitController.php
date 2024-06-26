<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Unit;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function searchUnit(Request $request) {
        $units = Unit::where('name', 'like', '%'.$request->search_string.'%')->orWhere('short_name', 'like', '%'.$request->search_string.'%')->orderBy('id', 'desc')->paginate(5);
        if($units->count() >= 1) {
        return view('backend.product.pagination-unit', compact('units'))->render();
        }else {
            return response()->json([
                'status' => 'nothing_found'
            ]);
        }
    }
    public function pagination(Request $request) {
        $units = Unit::latest()->paginate(5);
        return view('backend.product.pagination-unit', compact('units'))->render();
    }
    public function deleteUnit(Request $request) {
        $unit = Unit::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addUnit(Request $request) {
        $request->validate(
            [
                'name' => 'required|max:20',
                'short_name' => 'required|max:10',
                'is_active' => 'required',
            ],
            [
                'name' => 'Name is required',
                'short_name' => 'Short name is required',
                'is_active' => 'Status is required',
            ]
        );
        if($request->cu_id > 0) {
            $unit = Unit::find($request->cu_id);
        }else {
            $unit = new Unit();
            $unit->user_id = Auth::user()->id;
        }

        // Test
        $unit->name = $request->name;
        $unit->short_name = $request->short_name;
        $unit->branch_id = 1;
        $unit->is_active = $request->is_active;
        $unit->save();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $units = Unit::latest()->paginate(5);
        return view('backend.product.unit', compact('units'));
    }
}
