<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Backend\Product\Condition;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConditionController extends Controller
{
    public function getCondition()
    {
        $condition = Condition::orderBy('id', 'desc')->get();
        return response()->json($condition);
    }
    public function pagination(Request $request)
    {
        $conditions = Condition::latest()->paginate(10);
        return view('backend.product.pagination-condition', compact('conditions'))->render();
    }
    public function deleteCondition(Request $request)
    {
        $condition = Condition::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addCondition(Request $request)
    {
        $request->validate(
            [
                'title' => 'required',
                'is_active' => 'required'
            ],
            [
                'title' => 'Page is required',
                'is_active' => 'Status is required'
            ]
        );
        if ($request->cu_id > 0) {
            $condition = Condition::find($request->cu_id);
        } else {
            $condition = new Condition();
            $condition->user_id = Auth::user()->id;
        }

        $condition->branch_id = 1;
        $condition->title = $request->title;
        $condition->description = $request->description;
        $condition->is_active = $request->is_active;
        $condition->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $conditions = Condition::latest()->paginate(10);
        return view('backend.product.condition', compact('conditions'));
    }
}
