<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Unit;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function addUnit(request $request) {
        $request->validate(
            [
                'name' => 'required|max:20',
                'short_name' => 'required|max:10',
                'is_active' => 'required',
            ],
            [
                'name' => 'unit name required',
                'short_name' => 'required|max:10',
                'is_active' => 'required',
            ]
        );

        $unit = new Unit();
        $unit->name = $request->name;
        $unit->short_name = $request->short_name;
        $unit->branch_id = 1;
        $unit->user_id = Auth::user()->id;
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