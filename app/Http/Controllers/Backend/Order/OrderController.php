<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderDetail(Request $request) {
        $order = Order::with('Contact')->find($request->order_id);
        $order_detail = OrderDetail::with('ProductMainImage')->with('Product')->whereOrderId($request->order_id)->get();
        return response()->json(['order'=>$order, 'order_detail'=>$order_detail]);
    }
    public function index() {
        $new_orders = Order::whereStatus('processing')->get();
        return view('backend.order.new-order', compact('new_orders'));
    }
}
