<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Models\Backend\WebSetting\Slider;
use App\Models\Backend\Product\Category;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function pagination(Request $request) {
        $sliders = Slider::latest()->paginate(10);
        return view('backend.product.pagination-slider', compact('sliders'))->render();
    }
    public function deleteSlider(Request $request) {
        $slider = Slider::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addSlider(Request $request) {
        $request->validate(
            [
                'is_active' => 'required',
            ],
            [
                'is_active' => 'Status is required',
            ]
        );
        if($request->cu_id > 0) {
            $slider = Slider::find($request->cu_id);
        }else {
            $request->validate(
                [
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                ],
                [
                    'image' => 'Image is required',
                ]
            );
            $slider = new Slider();
            $slider->user_id = Auth::user()->id;
        }
        
        $slider->link = $request->link;
        if ($request->file('image')) {
            $imagePath = $request->file('image');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
            $image = $request->file('image')->store('images/blog_posts', 'public');
            $slider->image = $image;
        }
        
        $slider->position = $request->position;
        $slider->category_id = $request->category_id;
        $slider->branch_id = 1;
        $slider->is_active = $request->is_active;
        $slider->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index() {
        $sliders = Slider::latest()->paginate(10);
        $categories = Category::where('parent_category_id', '=', null)->orderBy('id', 'DESC')->get();
        return view('backend.web-setting.slider', compact('sliders', 'categories'));
    }
}
