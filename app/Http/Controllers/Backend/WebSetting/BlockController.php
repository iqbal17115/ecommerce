<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Models\Backend\WebSetting\Block;
use App\Models\Backend\Product\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function pagination(Request $request)
    {
        $blocks = Block::latest()->paginate(10);
        return view('backend.web-setting.pagination.block', compact('blocks'))->render();
    }
    public function deleteBlock(Request $request)
    {
        $block = Block::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addBlock(Request $request)
    {
        $request->validate(
            [
                'category_id' => 'required',
                'style' => 'required',
                'position' => 'required',
                'image' => 'image',
                'is_active' => 'required'
            ],
            [
                'category_id' => 'Category is required',
                'style' => 'Style is required',
                'position' => 'Position is required',
                'image' => 'Image is required',
                'is_active' => 'Status is required'
            ]
        );
        if ($request->cu_id > 0) {
            $block = Block::find($request->cu_id);
        } else {
            $block = new Block();
        }

        $block->category_id = $request->category_id;
        $block->position = $request->position;
        $block->style = $request->style;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $image = $request->file('image')->store('images/block', 'public');
            $block->image = $image;
        }
        $block->is_active = $request->is_active;
        $block->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $blocks = Block::latest()->paginate(10);
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        return view('backend.web-setting.block', compact('blocks', 'categories'));
    }
}
