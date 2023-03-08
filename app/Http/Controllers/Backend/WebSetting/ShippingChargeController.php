<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Backend\WebSetting\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function pagination(Request $request)
    {
        $shipping_charges = ShippingCharge::latest()->paginate(10);
        return view('backend.web-setting.pagination.shipping-charge', compact('shipping_charges'))->render();
    }
    public function deleteShippingCharge(Request $request)
    {
        $block = ShippingCharge::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addShippingCharge(Request $request)
    {

        if ($request->cu_id > 0) {
            $shipping_charge = ShippingCharge::find($request->cu_id);
        } else {
            if ($request->type == "Default") {
                $shipping_charge = ShippingCharge::whereType('Default')->firstOrNew();
            } else {
                $shipping_charge = new ShippingCharge();
            }
        }

        $shipping_charge->dimension_type = $request->dimension_type;
        $shipping_charge->type = $request->type;
        if ($request->type == "Default") {
            $shipping_charge->start = null;
            $shipping_charge->end = null;
        } else {
            $shipping_charge->start = $request->start;
            $shipping_charge->end = $request->end;
        }
        $shipping_charge->inside_amount = $request->inside_amount;
        $shipping_charge->outside_amount = $request->outside_amount;
        $shipping_charge->is_active = $request->is_active;
        $shipping_charge->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $shipping_charges = ShippingCharge::paginate(10);
        $dimension_type = "PerUnit";
        return view('backend.web-setting.shipping-charge', compact('shipping_charges', 'dimension_type'));
    }
}