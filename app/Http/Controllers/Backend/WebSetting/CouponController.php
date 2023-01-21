<?php

namespace App\Http\Controllers\Backend\WebSetting;

use App\Http\Controllers\Controller;
use App\Models\Backend\WebSetting\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function pagination(Request $request)
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('backend.product.pagination.coupon', compact('coupons'))->render();
    }
    public function deleteCoupon(Request $request)
    {
        $coupon = Coupon::find($request->id)->delete();
        return response()->json([
            'status' => 'success'
        ]);
    }
    public function addCoupon(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'is_active' => 'required'
            ],
            [
                'name' => 'Name is required',
                'type' => 'Discount Type is required',
                'start_date' => 'Start Date is required',
                'end_date' => 'End Date is required',
                'is_active' => 'Status is required'
            ]
        );
        if ($request->cu_id > 0) {
            $coupon = Coupon::find($request->cu_id);
        } else {
            $coupon = new Coupon();
        }

        $coupon->name = $request->name;
        $coupon->type = $request->type;
        $coupon->amount = $request->discount_amount;
        $coupon->start_date = $request->start_date;
        $coupon->end_date = $request->end_date;
        $coupon->is_active = $request->is_active;
        $coupon->save();

        return response()->json([
            'status' => 'success'
        ]);
    }
    public function index()
    {
        $coupons = Coupon::latest()->paginate(10);
        return view('backend.web-setting.coupon', compact('coupons'));
    }
}
