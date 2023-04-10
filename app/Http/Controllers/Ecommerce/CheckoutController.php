<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Product\Product;
use App\Models\Backend\WebSetting\ShippingCharge;
use App\Models\Ecommerce\Setting\District;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Setting\Division;
use App\Models\Ecommerce\Setting\Union;
use App\Models\Ecommerce\Setting\Upazila;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function confirmOrder(Request $request)
    {
        DB::transaction(function () use ($request) {
            $total = 0;
            if(!session('cart')) {
                return Redirect::back();
            }
            foreach (session('cart') as $id => $details) {
                $total += $details['sale_price'] * $details['quantity'];
            }
            if (count(session('cart')) > 0) {
                //    Add Customer
                $Query = Contact::whereUserId(Auth::user()->id)->first();
                $Query->type = 'Customer';
                $Query->division_id = $request->division_id;
                $Query->district_id = $request->district_id;
                $Query->upazilla_id = $request->upazilla_id;
                $Query->union_id = $request->union_id;
                $Query->shipping_address = $request->shipping_address;
                $Query->mobile = $request->shipping_contact_no;
                $Query->save();

                //    Add Order
                $Order = new Order();
                $Order->code = 'OC' . floor(time() - 999999999);
                $Order->contact_id = $Query->id;
                $Order->order_date = Carbon::now();
                $Order->total_amount = $total;
                $Order->payable_amount = $total;
                $Order->status = 'processing';
                $Order->note = $request->note;
                $Order->is_active = 1;
                $Order->save();

                // Add To Order Details
                foreach (session('cart') as $key=>$OrderProductDetail) {
                    // $OrderProductDetails = json_decode($OrderProductDetail->data);
                    $ProductQuery = Product::find($key);

                    $OrderDetails = new OrderDetail();
                    if ($ProductQuery) {
                        $OrderDetails->vendor_id = $ProductQuery->vendor_id;
                    }
                    $OrderDetails->order_id = $Order->id;
                    $OrderDetails->product_id = $key;
                    $OrderDetails->unit_price = $OrderProductDetail['sale_price'];
                    $OrderDetails->quantity = $OrderProductDetail['quantity'];
                    $OrderDetails->is_active = 1;
                    $OrderDetails->save();
                }

                //   Delete Add To Cart
                $request->session()->forget('cart');

           
            }
        });
        return Redirect::back();
    }
    public function getUnion(Request $request)
    {
        $union = Union::where('upazilla_id', '=', $request->upazila_id)->get();
        return response()->json(['union' => $union], 200);
    }
    public function getUpazila(Request $request)
    {
        $upazila = Upazila::where('district_id', '=', $request->district_id)->get();
        return response()->json(['upazila' => $upazila], 200);
    }
    public function getDistrict(Request $request)
    {
        $district = District::where('division_id', '=', $request->division_id)->get();
        return response()->json(['district' => $district], 200);
    }
    public function index()
    {
        $divisions = Division::get();
        $charge = ShippingCharge::whereType('Default')->first();
        $weight = ShippingCharge::whereType('Weight')->first();
        $area = ShippingCharge::whereType('Area')->first();
        return view('ecommerce.checkout', compact('divisions', 'charge', 'weight', 'area'));
    }
}