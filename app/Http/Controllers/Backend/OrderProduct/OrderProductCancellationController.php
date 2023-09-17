<?php

namespace App\Http\Controllers\Backend\OrderProduct;

use App\Enums\ProductCancelReasonEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderProduct\OrderProductCancellationRequest;
use App\Models\Backend\OrderProduct\OrderQuantityChange;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderProductCancellationController extends Controller
{
    public function storeOrUpdate(OrderProductCancellationRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            foreach ($data['order_detail_id'] as $index => $orderDetailId) {
                if (isset($data['new_quantity'][$index]) && $data['new_quantity'][$index]) {
                    $previousQuantity = $data['previous_quantity'][$index];
                    $newQuantity = $data['new_quantity'][$index];
                        // Create a new record.
                        OrderQuantityChange::create([
                            'order_detail_id' => $orderDetailId,
                            'previous_quantity' => $previousQuantity,
                            'new_quantity' => $newQuantity,
                        ]);

                    // Update OrderDetail with the new quantity.
                    $orderDetail = OrderDetail::find($orderDetailId);

                    if ($orderDetail) {
                        $orderDetail->update(['quantity' => $newQuantity]);
                    }

                    // Update Order with the new total amount.
                    $order = Order::find($orderDetail->order_id);
                    if ($order) {
                        $newTotalAmount = $order->total_amount + ($orderDetail->unit_price * ($newQuantity - $previousQuantity));
                        $order->update(['total_amount' => $newTotalAmount]);
                    }
                }
            }
        });

    }
    public function index(Order $order)
    {
        $cancel_reasons = ProductCancelReasonEnum::getCancelOptions();
        return view('backend.order-product.cancellation-product', compact('order', 'cancel_reasons'));
    }
}
