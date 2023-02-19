<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Ecommerce\Setting\District;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Setting\Division;
use App\Models\Ecommerce\Setting\Union;
use App\Models\Ecommerce\Setting\Upazila;

class CheckoutController extends Controller
{
    public function getUnion(Request $request) {
        $union = Union::where('upazilla_id', '=', $request->upazila_id)->get();
        return response()->json(['union' => $union], 200);
    }
    public function getUpazila(Request $request) {
        $upazila = Upazila::where('district_id', '=', $request->district_id)->get();
        return response()->json(['upazila' => $upazila], 200);
    }
    public function getDistrict(Request $request) {
        $district = District::where('division_id', '=', $request->division_id)->get();
        return response()->json(['district' => $district], 200);
    }
    public function index()
    {
        $divisions = Division::get();
        return view('ecommerce.checkout', compact('divisions'));
    }
}