<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Models\Backend\WebSetting\Advertisement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function pagination(Request $request)
    {
        $advertisements = Advertisement::latest()->paginate(10);
        return view('backend.product.pagination.advertisement', compact('advertisements'))->render();
    }
    public function deleteAdvertisement(Request $request)
    {
        $advertisement = Advertisement::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addAdvertisement(Request $request)
    {
        $request->validate(
            [
                'page' => 'required',
                'style' => 'required',
                'is_active' => 'required'
            ],
            [
                'page' => 'Page is required',
                'style' => 'Style is required',
                'is_active' => 'Status is required'
            ]
        );
        if ($request->cu_id > 0) {
            $advertisement = Advertisement::find($request->cu_id);
        } else {
            $advertisement = new Advertisement();
        }

        $advertisement->page = $request->page;
        $advertisement->position = $request->position;
        $advertisement->style = $request->style;
        $advertisement->width = $request->width;
        if ($request->style == "Style One") {
            $advertisement->title = $request->title;
            $advertisement->sub_title = $request->sub_title;
        } else if ($request->style == "Style Two") {
            $advertisement->title = $request->title;
            $advertisement->sub_title = $request->sub_title;
            $advertisement->offer = $request->offer;
            if ($request->file('embed_code_or_image1')) {
                $imagePath = $request->file('embed_code_or_image1');
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
                $image = $request->file('image')->store('images/advertisement', 'public');
                $advertisement->image = $image;
            }
        } else if ($request->style == "Style Three") {
            $advertisement->title = $request->title;
            $advertisement->sub_title = $request->sub_title;
            $advertisement->offer = $request->offer;
            if ($request->file('embed_code_or_image1')) {
                $imagePath = $request->file('embed_code_or_image1');
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
                $image = $request->file('image')->store('images/advertisement', 'public');
                $advertisement->image = $image;
            }
        } else if ($request->style == "Style Four") {
            $advertisement->title = $request->title;
            $advertisement->sub_title = $request->sub_title;
            if ($request->file('embed_code_or_image1')) {
                $imagePath = $request->file('embed_code_or_image1');
                $imageName = $imagePath->getClientOriginalName();
                $path = $request->file('image')->storeAs('uploads', $imageName, 'public');
                $image = $request->file('image')->store('images/advertisement', 'public');
                $advertisement->image = $image;
            }
        }


        $advertisement->is_active = $request->is_active;
        $advertisement->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $advertisements = Advertisement::latest()->paginate(10);
        return view('backend.web-setting.advertisement', compact('advertisements'));
    }
}