<?php

namespace App\Services;

use App\Enums\EntryTypeEnums;
use App\Enums\OrderStatusEnum;
use App\Enums\TransactionTypeEnums;
use App\Models\Account;
use App\Models\Commission;
use App\Models\CommissionSupplier;
use App\Models\JournalEntry;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\Transaction;
use App\Models\InvoiceNumberSetting;
use App\Enums\InvoiceNumberSettingEnum;
use App\Helpers\Utils;
use App\Http\Requests\Order\OrderCancelRequest;
use App\Models\Backend\Order\OrderTracking;
use App\Models\Backend\OrderProduct\OrderNoteStatus;
use App\Models\FrontEnd\Order;
use App\Traits\BaseModel;
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
        });

        $data = $this->getOrderStatusData($validatedData);

        return response()->json([
            'message' => 'Order Status Changed Successfully!',
            'data' => $data
        ], 200);
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
