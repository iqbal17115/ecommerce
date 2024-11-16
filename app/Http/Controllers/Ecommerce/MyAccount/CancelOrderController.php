<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Enums\OrderStatusEnum;
use App\Enums\ProductCancelReasonEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\MyAccount\UserOrderProductCancellationRequest;
use App\Models\Backend\Order\OrderTracking;
use App\Models\Backend\OrderProduct\OrderQuantityChange;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CancelOrderController extends Controller
{
    public function storeOrUpdate(UserOrderProductCancellationRequest $userOrderProductCancellationRequest)
    {
        $data = $userOrderProductCancellationRequest->validated();

        $orderDetailIds = $data['order_detail_ids'];
        $previousQuantities = $data['previous_quantities'];
        $newQuantities = $data['new_quantities'];
        DB::transaction(function () use ($orderDetailIds, $previousQuantities, $newQuantities) {
        $order_detail_id = $orderDetailIds[0]['id'];
        $flagOrderDetail = OrderDetail::find($order_detail_id);

            $allChecked = count(array_filter($orderDetailIds, function ($checked) {
                return $checked['checked'] === true;
            })) === count($orderDetailIds);

            if ($allChecked) {
                $orderDetail = OrderDetail::find($orderDetailIds[0]['id']);
                $order = Order::find($orderDetail->order_id);
                $order->status = OrderStatusEnum::CANCELLED;
                $order->save();

                $order = OrderTracking::updateOrCreate(
                    [
                        'order_id' => $order->id,
                        'status' => OrderStatusEnum::CANCELLED,
                    ],
                    [
                        'status' => OrderStatusEnum::CANCELLED,
                        'created_by' => Auth::user()->id
                    ],
                );
            } else {
                // Update quantities and create records for new quantities
                foreach ($orderDetailIds as $index => $orderDetailId) {
                    if ($newQuantities[$index] && !$orderDetailIds[$index]['checked']) {
                        $previousQuantity = $previousQuantities[$index];
                        $newQuantity = $newQuantities[$index];

                        // Create a new record.
                        OrderQuantityChange::create([
                            'order_detail_id' => $orderDetailId['id'],
                            'previous_quantity' => $previousQuantity,
                            'new_quantity' => $newQuantity,
                        ]);

                        // Update OrderDetail with the new quantity.
                        $orderDetail = OrderDetail::find($orderDetailId['id']);

                        if ($orderDetail) {
                            $orderDetail->update(['quantity' => $newQuantity]);
                        }
                    }

                    if ($orderDetailIds[$index]['checked']) {
                        OrderDetail::find($orderDetailId['id'])->delete();
                    }
                }


                $orderDetail = OrderDetail::find($order_detail_id);
                // Calculate the new total amount for the order
                $order = Order::find($flagOrderDetail->order_id);
                $orderDetails = OrderDetail::whereIn('id', array_column($orderDetailIds, 'id'))->get();

                $newTotalAmount = 0;

                foreach ($orderDetails as $orderDetail) {
                    $newTotalAmount += $orderDetail->unit_price * $orderDetail->quantity;
                }

                $order->update(['total_amount' => $newTotalAmount]);
            }
        });


        return response()->json(
            [
                'message' => 'Successfull!!'
            ],
            200
        );
    }

    /**
     * @throws Exception
     */
    public function index(Order $order): View|JsonResponse
    {
        $cancel_reasons = ProductCancelReasonEnum::getCancelOptions();
        return view('ecommerce.my-account.cancel_order.cancel_order', compact('order', 'cancel_reasons'));
    }
}
