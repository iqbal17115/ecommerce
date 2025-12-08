<?php

namespace App\Http\Controllers\Ecommerce;

use App\Enums\OrderStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\Address\District;
use App\Models\Address\Division;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\Backend\Order\OrderTracking;
use Illuminate\Http\Request;
use App\Models\Ecommerce\Setting\Union;
use App\Models\Ecommerce\Setting\Upazila;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Services\ShippingChargeService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    protected $shippingChargeService;

    public function __construct(ShippingChargeService $shippingChargeService)
    {
        $this->shippingChargeService = $shippingChargeService;
    }
    public function addShippingAddress(Request $request)
    {
        //    Add Customer
        // $Query = Contact::whereUserId(Auth::user()->id)->first();
        // $Query->type = 'Customer';
        // $Query->division_id = $request->division_id;
        // $Query->district_id = $request->district_id;
        // $Query->upazilla_id = $request->upazilla_id;
        // $Query->union_id = $request->union_id;
        // $Query->shipping_address = $request->shipping_address;
        // $Query->mobile = $request->shipping_contact_no;
        // $Query->save();

        return response()->json(['status' => 'success', 'message' => 'Shipping address saved successfully']);
    }
    public function showOrderConfirmation(Order $order)
    {
        // Pass the order data to the view
        return view('ecommerce.order_confirmation', compact('order'));
    }
    public function confirmOrder(Request $request)
    {
        DB::transaction(function () use ($request) {
            $total = 0;
            if (!session('cart')) {
                return Redirect::back();
            }
            $detail_data = $this->shippingChargeService->calculateShippingCharge($request->shipping_method);

            if (count(session('cart')) > 0) {
                //    Add Order
                $Order = new Order();
                $Order->code = 'OC' . floor(time() - 999999999);
                $Order->contact_id = Auth::user()->Contact->id;
                $Order->order_date = Carbon::now();
                $Order->total_amount = $detail_data->getData()->sub_total;
                $Order->shipping_charge = $detail_data->getData()->charge;
                $Order->payable_amount = $detail_data->getData()->sub_total + $detail_data->getData()->charge;
                $Order->status = OrderStatusEnum::PROCESSING;
                $Order->note = $request->note;
                $Order->is_active = 1;
                $Order->save();

                // Order Tracking
                $order = OrderTracking::updateOrCreate(
                    ['order_id' => $Order->id],
                    [
                        'status' => OrderStatusEnum::PENDING,
                        'created_by' => Auth::user()->id
                    ],
                );

                // Add To Order Details
                foreach (session('cart') as $key => $OrderProductDetail) {
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

                $request->session()->put('confirmed_order', $Order);
            }
        });

        return response()->json(['status' => 'success']);
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
        $contact = Contact::whereUserId($request->user()->id)->first();
        $contact->division_id = $request->division_id;
        $contact->save();
        $district = District::where('division_id', '=', $request->division_id)->get();
        return response()->json(['district' => $district], 200);
    }
    public function index()
    {
        $divisions = Division::get();
        if (!is_null(session('cart'))) {
            $products = array_filter(session('cart'), function ($details) {
                return $details['status'] == 1;
            });
        } else {
            // Handle the case where session('cart') is null or not set
            // You might want to set $products to an empty array or handle it accordingly
            $products = [];
        }
        $user = Auth::user();
        $user_id = auth()?->user()->id ?? null;
        return view('ecommerce.checkout.index', compact('divisions', 'products', 'user', 'user_id'));
    }
}
