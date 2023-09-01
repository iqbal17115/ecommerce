<?php

namespace App\Http\Controllers\Backend\Order;

use App\Enums\LengthUnitEnum;
use App\Enums\OrderStatusEnum;
use App\Enums\PaymentMethodEnum;
use App\Enums\PaymentStatusEnum;
use App\Enums\PaymentTypeEnum;
use App\Enums\ProductCancelReasonEnum;
use App\Enums\WeightUnitEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\OrderFulfilmentNoteRequest;
use App\Http\Requests\Order\OrderNoteRequest;
use App\Http\Requests\Order\OrderPaymentNoteRequest;
use App\Http\Requests\Order\OrderPaymentRequest;
use App\Http\Requests\Order\OrderPaymentStatusRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Order\OrderStatusRequest;
use App\Models\Backend\OrderProduct\OrderNoteStatus;
use App\Models\Backend\OrderProduct\OrderPayment;
use App\Models\FrontEnd\Order;

class AllOrderController extends Controller
{
    public function orderPaymentSave(OrderPaymentRequest $orderPaymentRequest, Order $order)
    {
        $orderpayment = OrderPayment::firstOrNew(['order_id' => $order->id]);
        $orderpayment->payment_type = $orderPaymentRequest->validated()['payment_type'];
        $orderpayment->payment_method = $orderPaymentRequest->validated()['payment_method'];
        $orderpayment->payment_id = $orderPaymentRequest->validated()['payment_id'];
        $orderpayment->payment_date = $orderPaymentRequest->validated()['payment_date'];
        $orderpayment->save();

        return response()->json(
            [
                'message' => 'Order payment details saved'
            ],
            200
        );
    }

    public function orderPaymentStatus(OrderPaymentStatusRequest $orderPaymentStatusRequest, Order $order)
    {

        $orderNote = OrderNoteStatus::firstOrNew(['order_id' => $order->id]);
        $orderNote->payment_status = $orderPaymentStatusRequest->validated()['payment_status'];
        $orderNote->save();

        return response()->json(
            [
                'message' => 'Order payment status saved'
            ],
            200
        );
    }

    public function orderFulfilmentNotetSave(OrderFulfilmentNoteRequest $orderFulfilmentNoteRequest, Order $order)
    {

        $orderNote = OrderNoteStatus::firstOrNew(['order_id' => $order->id]);
        $existingOrderNote = json_decode($orderNote->fulfilment_note, true) ?? [];

        $newNote = [
            'note' => $orderFulfilmentNoteRequest->validated()['fulfilment_note'],
            'note_type' => $orderFulfilmentNoteRequest->validated()['order_fulfilment_note_type'],
            'created_at' => now()->format('F j, Y h:i A'), // Format the date and time
        ];
        
        $existingOrderNote[] = $newNote;

        $orderNote->fulfilment_note = json_encode($existingOrderNote);
        $orderNote->save();

        return response()->json(
            [
                'message' => 'Fulfilment note saved',
                'data' => $newNote
            ],
            200
        );
    }

    public function orderNotePaymentSave(OrderPaymentNoteRequest $orderPaymentNoteRequest, Order $order)
    {

        $orderNote = OrderNoteStatus::firstOrNew(['order_id' => $order->id]);
        $existingOrderNote = json_decode($orderNote->payment_note, true) ?? [];

        $newNote = [
            'note' => $orderPaymentNoteRequest->validated()['payment_note'],
            'note_type' => $orderPaymentNoteRequest->validated()['order_payment_note_type'],
            'created_at' => now()->format('F j, Y h:i A'), // Format the date and time
        ];
        
        $existingOrderNote[] = $newNote;

        $orderNote->payment_note = json_encode($existingOrderNote);
        $orderNote->save();

        return response()->json(
            [
                'message' => 'Payment note saved',
                'data' => $newNote
            ],
            200
        );
    }

    public function orderNote(OrderNoteRequest $orderNoteRequest, Order $order)
    {

        $orderNote = OrderNoteStatus::firstOrNew(['order_id' => $order->id]);
        $existingOrderNote = json_decode($orderNote->order_note, true) ?? [];

        $newNote = [
            'note' => $orderNoteRequest->validated()['order_note'],
            'note_type' => $orderNoteRequest->validated()['order_note_type'],
            'created_at' => now()->format('F j, Y h:i A'), // Format the date and time
        ];
        
        $existingOrderNote[] = $newNote;

        $orderNote->order_note = json_encode($existingOrderNote);
        $orderNote->save();

        return response()->json(
            [
                'message' => 'Order note saved',
                'data' => $newNote
            ],
            200
        );
    }

    public function confirmOrder(Order $order)
    {
        $order->status = 'processing';
        $order->save();

        $data = [
            'status' => "processing"
        ];

        return response()->json([
            'message' => 'Order confirmed successfully',
            'data' => $data
        ], 200);
    }
    public function cancelOrder(OrderStatusRequest $orderStatusRequest, Order $order)
    {
        DB::transaction(function () use ($orderStatusRequest, $order) {
            $order->status = $orderStatusRequest->validated()['status'];
            $order->save();

            $orderNoteStatus = OrderNoteStatus::firstOrNew(['order_id' => $order->id]);
            $orderNoteStatus->fulfilment_note = $orderStatusRequest->validated()['fulfilment_note'];
            $orderNoteStatus->save();

        });

        $data = [
            'status' => $orderStatusRequest->validated()['status'],
            'fulfilment_note' => $orderStatusRequest->validated()['fulfilment_note']
        ];

        return response()->json([
            'message' => 'Order canceled successfully',
            'data' => $data
        ], 200);
    }

    public function advanceEdit(Order $order)
    {
        $lengthUnits = LengthUnitEnum::getOptions();
        $weightUnits = WeightUnitEnum::getWeightOptions();
        $cancel_reasons = ProductCancelReasonEnum::getCancelOptions();
        $reflectionClass = new \ReflectionClass(OrderStatusEnum::class);
        $orderStatuses = array_values($reflectionClass->getConstants());
        $paymentStatuses = PaymentStatusEnum::getPaymentStatuses();
        $paymentTypes = PaymentTypeEnum::getPaymentTypes();
        $paymentMethods = PaymentMethodEnum::getPaymentMethods();
        return view('backend.order.advance-edit', compact('order', 'lengthUnits', 'weightUnits', 'cancel_reasons', 'orderStatuses', 'paymentStatuses', 'paymentTypes', 'paymentMethods'));
    }

    public function index()
    {
        $reflectionClass = new \ReflectionClass(OrderStatusEnum::class);
        $statusValues = array_values($reflectionClass->getConstants());
        return view('backend.order.all-order', compact('statusValues'));
    }
}