<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Models\Backend\WebSetting\Advertisement;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product\ProductFeature;
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
                'position' => 'required',
                'product_feature_id' => 'required',
                'width' => 'required',
                'is_active' => 'required'
            ],
            [
                'page' => 'Page is required',
                'position' => 'Position is required',
                'product_feature_id' => 'Product Feature is required',
                'width' => 'Width is required',
                'is_active' => 'Status is required'
            ]
        );
        if ($request->cu_id > 0) {
            $advertisement = Advertisement::find($request->cu_id);
        } else {
            $request->validate(
                [
                    'ads' => 'required'
                ]
            );
            $advertisement = new Advertisement();
        }

        $advertisement->page = $request->page;
        $advertisement->position = $request->position;
        $advertisement->width = $request->width;
        $advertisement->product_feature_id = $request->product_feature_id;

        if ($request->file('ads')) {
            $imagePath = $request->file('ads');
            $imageName = $imagePath->getClientOriginalName();
            $path = $request->file('ads')->storeAs('uploads', $imageName, 'public');
            $image = $request->file('ads')->store('images/advertisement', 'public');
            $advertisement->ads = $image;
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
        $product_features = ProductFeature::whereIsActive(1)->orderBy('id', 'DESC')->get();
        return view('backend.web-setting.advertisement', compact('advertisements', 'product_features'));
    }
}