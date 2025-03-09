<?php

namespace App\Services\MyAccount;

use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Models\ReturnRequest;
use App\Models\ReturnRequestItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MyAccountOrderReturnProductService
{
    public function createReturnRequest(array $data)
    {
        DB::beginTransaction();
        try {
            $order = Order::findOrFail($data['order_id']);

            $returnRequest = ReturnRequest::create([
                'order_id' => $order->id,
                'user_id' => Auth::id(),
                'return_reason' => $data['return_reason'],
                'refund_method' => $data['refund_method'],
                'refund_amount' => $data['refund_amount'],
                'comment' => $data['comment'] ?? null,
            ]);

            foreach ($data['products'] as $productData) {
                $orderDetail = OrderDetail::findOrFail($productData['order_detail_id']);

                ReturnRequestItem::create([
                    'return_request_id' => $returnRequest->id,
                    'order_detail_id' => $orderDetail->id,
                    'quantity' => $productData['quantity'],
                    'unit_price' => $productData['unit_price'],
                    'subtotal' => $productData['subtotal'],
                ]);

                $orderDetail->update([
                    'return_quantity' => $productData['quantity'],
                    'return_reason' => $data['return_reason'],
                    'return_status' => 'pending',
                ]);
            }

            $order->update(['return_status' => 'pending']);

            DB::commit();
            return $returnRequest;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function processReturn(ReturnRequest $returnRequest, $status)
    {
        DB::beginTransaction();
        try {
            $order = $returnRequest->order;
            foreach ($returnRequest->items as $item) {
                $item->orderDetail->update(['return_status' => $status]);
            }
            $returnRequest->update(['status' => $status]);

            if ($status === 'approved') {
                $this->processRefund($returnRequest);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function processRefund(ReturnRequest $returnRequest)
    {
        $orderPayment = $returnRequest->order->payments->first(); // Assuming one payment per order.
        if ($orderPayment) {
            $orderPayment->update([
                'amount_paid' => $orderPayment->amount_paid - $returnRequest->refund_amount,
                'due_amount' => $orderPayment->due_amount + $returnRequest->refund_amount,
            ]);
        }
    }

    public function getOrderDetailsForReturn(Order $order)
    {
        return $order->orderDetails()->with('product')->get();
    }
}
