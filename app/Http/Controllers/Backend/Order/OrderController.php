<?php

namespace App\Http\Controllers\Backend\Order;

use App\Enums\ProductStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function allOrderIndex()
    {
        $orders = $this->orderService->getOrdersByStatus([ProductStatusEnum::PENDING->value, ProductStatusEnum::APPROVE->value, ProductStatusEnum::CANCEL->value]);
        return view('backend.order.all-order', compact('orders'));
    }

    /**
     * Cancel Order
     *
     * @param Order $order
     * @return View|
     */
    public function cancelOrderShow(Order $order): View
    {
        return view('backend.order.cancel-order', compact('order'));
    }

    /**
     * Confirm Order
     *
     * @param Order $order
     * @return View|
     */
    public function confirmOrderShow(Order $order): View
    {
        return view('backend.order.confirm-order', compact('order'));
    }
    /**
     * Order
     *
     * @param Order $order
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function invoicesDetail(Order $order): View|\Illuminate\Foundation\Application|Factory|Application
    {
        return view('backend.order.invoices-detail', compact('order'));
    }
    public function destroy(Order $order)
    {
        $this->orderService->deleteOrder($order);

        return redirect()->back()->with('success', 'Order deleted successfully.');
    }
    public function orderDetail(Request $request)
    {
        $order = Order::with('Contact')->find($request->order_id);
        $order_detail = OrderDetail::with('ProductMainImage')->with('Product')->whereOrderId($request->order_id)->get();
        return response()->json(['order' => $order, 'order_detail' => $order_detail]);
    }
    public function index()
    {
        $new_orders = Order::whereStatus('processing')->get();
        return view('backend.order.new-order', compact('new_orders'));
    }
}
