<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Models\Backend\WebSetting\Advertisement;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function pagination(Request $request)
    {
        $advertisements = Advertisement::latest()->paginate(10);
        return view('backend.product.pagination-advertisement', compact('advertisements'))->render();
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
                'type' => 'required',
                'is_active' => 'required'
            ],
            [
                'page' => 'Page is required',
                'style' => 'Style is required',
                'type' => 'Type is required',
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
        $advertisement->type = $request->type;
        if ($request->style == "Style One") {
            // 1st Image Or URL
            if ($request->type == "Image Ads") {
                if ($request->cu_id < 0) {
                    $request->validate(
                        [
                            'embed_code_or_image1' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
                        ],
                        [
                            'embed_code_or_image1' => 'Image1 is required'
                        ]
                    );
                }
                if ($request->file('embed_code_or_image1')) {
                    $imagePath = $request->file('embed_code_or_image1');
                    $imageName = $imagePath->getClientOriginalName();
                    $path = $request->file('embed_code_or_image1')->storeAs('uploads', $imageName, 'public');
                    $embed_code_or_image1 = $request->file('embed_code_or_image1')->store('images/advertisement', 'public');
                    $advertisement->embed_code_or_image1 = $embed_code_or_image1;
                }
            } else {
                $request->validate(
                    [
                        'embed_code_or_image1' => 'required'
                    ],
                    [
                        'embed_code_or_image1' => 'Embed Code1 is required'
                    ]
                );
                $advertisement->embed_code_or_image1 = $request->embed_code_or_image1;
            }
        } else if ($request->style == "Style Two") {
            if ($request->type == "Image Ads") {
                if ($request->cu_id < 0) {
                    $request->validate(
                        [
                            'embed_code_or_image1' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                            'embed_code_or_image2' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
                        ],
                        [
                            'embed_code_or_image1' => 'Image1 is required',
                            'embed_code_or_image2' => 'Image2 is required',
                        ]
                    );
                }
                // 1st Image
                if ($request->file('embed_code_or_image1')) {
                    $imagePath = $request->file('embed_code_or_image1');
                    $imageName = $imagePath->getClientOriginalName();
                    $path = $request->file('embed_code_or_image1')->storeAs('uploads', $imageName, 'public');
                    $embed_code_or_image1 = $request->file('embed_code_or_image1')->store('images/advertisement', 'public');
                    $advertisement->embed_code_or_image1 = $embed_code_or_image1;
                }
                // 2nd Image
                if ($request->file('embed_code_or_image2')) {
                    $imagePath = $request->file('embed_code_or_image2');
                    $imageName = $imagePath->getClientOriginalName();
                    $path = $request->file('embed_code_or_image2')->storeAs('uploads', $imageName, 'public');
                    $embed_code_or_image2 = $request->file('embed_code_or_image2')->store('images/advertisement', 'public');
                    $advertisement->embed_code_or_image2 = $embed_code_or_image2;
                }
            } else {
                $request->validate(
                    [
                        'embed_code_or_image1' => 'required',
                        'embed_code_or_image2' => 'required'
                    ],
                    [
                        'embed_code_or_image1' => 'Embed Code1 is required',
                        'embed_code_or_image2' => 'Embed Code2 is required'
                    ]
                );

                $advertisement->embed_code_or_image1 = $request->embed_code_or_image1;
                $advertisement->embed_code_or_image2 = $request->embed_code_or_image2;
            }
        } else {
            if ($request->type == "Image Ads") {
                if ($request->cu_id < 0) {
                    $request->validate(
                        [
                            'embed_code_or_image1' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                            'embed_code_or_image2' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                            'embed_code_or_image3' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
                        ],
                        [
                            'embed_code_or_image1' => 'Image1 is required',
                            'embed_code_or_image2' => 'Image2 is required',
                            'embed_code_or_image3' => 'Image3 is required'
                        ]
                    );
                }
                // 1st Image
                if ($request->file('embed_code_or_image1')) {
                    $imagePath = $request->file('embed_code_or_image1');
                    $imageName = $imagePath->getClientOriginalName();
                    $path = $request->file('embed_code_or_image1')->storeAs('uploads', $imageName, 'public');
                    $embed_code_or_image1 = $request->file('embed_code_or_image1')->store('images/advertisement', 'public');
                    $advertisement->embed_code_or_image1 = $embed_code_or_image1;
                }
                // 2nd Image
                if ($request->file('embed_code_or_image2')) {
                    $imagePath = $request->file('embed_code_or_image2');
                    $imageName = $imagePath->getClientOriginalName();
                    $path = $request->file('embed_code_or_image2')->storeAs('uploads', $imageName, 'public');
                    $embed_code_or_image2 = $request->file('embed_code_or_image2')->store('images/advertisement', 'public');
                    $advertisement->embed_code_or_image2 = $embed_code_or_image2;
                }
                // 3rd Image
                if ($request->file('embed_code_or_image3')) {
                    $imagePath = $request->file('embed_code_or_image3');
                    $imageName = $imagePath->getClientOriginalName();
                    $path = $request->file('embed_code_or_image3')->storeAs('uploads', $imageName, 'public');
                    $embed_code_or_image3 = $request->file('embed_code_or_image3')->store('images/advertisement', 'public');
                    $advertisement->embed_code_or_image3 = $embed_code_or_image3;
                }
            } else {
                $request->validate(
                    [
                        'embed_code_or_image1' => 'required',
                        'embed_code_or_image2' => 'required',
                        'embed_code_or_image3' => 'required'
                    ],
                    [
                        'embed_code_or_image1' => 'Embed Code1 is required',
                        'embed_code_or_image2' => 'Embed Code2 is required',
                        'embed_code_or_image3' => 'Embed Code3 is required'
                    ]
                );
                $advertisement->embed_code_or_image1 = $request->embed_code_or_image1;
                $advertisement->embed_code_or_image2 = $request->embed_code_or_image2;
                $advertisement->embed_code_or_image3 = $request->embed_code_or_image3;
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
