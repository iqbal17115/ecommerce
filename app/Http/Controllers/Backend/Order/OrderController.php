<?php

namespace App\Http\Controllers\Backend\Order;

use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order);

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
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
