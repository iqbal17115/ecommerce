<?php

namespace App\Services;

use App\Enums\DecreaseStatusEnum;
use App\Enums\IncreaseStatusEnum;
use App\Http\Requests\Order\OrderCancelRequest;
use App\Models\Backend\Order\OrderTracking;
use App\Models\Backend\OrderProduct\OrderNoteStatus;
use App\Models\Backend\Product\Product;
use App\Models\FrontEnd\Order;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvanceEditOrderService extends ConvertToSaleService
{
    public function cancelOrder(OrderCancelRequest $orderCancelRequest, Order $order)
    {
        DB::transaction(function () use ($orderCancelRequest, $order) {
            $this->updateOrderAndSale($order, $orderCancelRequest);
        });

        return $this->getOrderAndSaleData($orderCancelRequest);
    }

    public function updateOrderAndSale($order, $orderCancelRequest)
    {
        // Update Order
        $order->status = $orderCancelRequest->validated()['status'];
        $order->save();

        // Update OrderNoteStatus
        $orderNoteStatus = OrderNoteStatus::firstOrNew(['order_id' => $order->id]);
        $orderNoteStatus->fulfilment_note = $orderCancelRequest->validated()['fulfilment_note'];
        $orderNoteStatus->save();

        // Check if $order has an associated Sale
        if ($order->sale) {
            // Update Sale status
            $order->sale->status = $orderCancelRequest->validated()['status'];
            $order->sale->save();
        }
    }

    public function getOrderAndSaleData($orderCancelRequest)
    {
        return [
            'status' => $orderCancelRequest->validated()['status'],
            'fulfilment_note' => $orderCancelRequest->validated()['fulfilment_note']
        ];
    }

    public function createUpdateStatus($validatedData, Order $order)
    {
        DB::transaction(function () use ($validatedData, $order) {
            $sale = $this->convertToSale($order);
            $this->updateOrderStatus($validatedData, $order);
            $this->updateStockQty($validatedData, $order);
        });

        $data = $this->getOrderStatusData($validatedData);

        return response()->json([
            'message' => 'Order Status Changed Successfully!',
            'data' => $data
        ], 200);
    }

    public function updateStockQty($validatedData, Order $order)
    {
        $newStatus = $validatedData['order_status'];
        $oldStatus = $order->status;

        if ($newStatus == $oldStatus) {
            return;
        }

        $products = $order->OrderDetail;

        if (in_array($oldStatus, DecreaseStatusEnum::DECREASE_STATUSES())) {
            $this->increaseStockQty($products);
        }

        if (in_array($newStatus, DecreaseStatusEnum::DECREASE_STATUSES())) {
            $this->decreaseStockQty($products);
        } elseif (in_array($newStatus, IncreaseStatusEnum::INCREASE_STATUSES())) {
            $this->increaseStockQty($products);
        }
    }

    protected function decreaseStockQty($products)
    {
        foreach ($products as $product) {
            $quantity = $product->quantity;
            Product::where('id', $product->product_id)->decrement('stock_qty', $quantity);
        }
    }

    protected function increaseStockQty($products)
    {
        foreach ($products as $product) {
            $quantity = $product->quantity;
            Product::where('id', $product->product_id)->increment('stock_qty', $quantity);
        }
    }

    public function updateOrderStatus($validatedData, Order $order)
    {
        OrderTracking::updateOrCreate(
            [
                'order_id' => $order->id,
                'status' => $validatedData->order_status,
            ],
            [
                'status' => $validatedData->order_status,
                'created_by' => Auth::user()->id
            ]
        );
    }

    public function getOrderStatusData($validatedData)
    {
        return [
            'status' => $validatedData->order_status,
            'created_at' => now()->format('d M Y')
        ];
    }

    public function store($order)
    {
        $this->convertToSale($order);
    }
}
