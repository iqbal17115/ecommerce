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
use App\Http\Requests\Order\OrderPackageRequest;
use App\Http\Requests\Order\OrderPaymentNoteRequest;
use App\Http\Requests\Order\OrderPaymentRequest;
use App\Http\Requests\Order\OrderPaymentStatusRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Order\OrderStatusRequest;
use App\Models\Backend\OrderProduct\OrderNoteStatus;
use App\Models\Backend\OrderProduct\OrderPayment;
use App\Models\Backend\OrderProduct\OrderProductBox;
use App\Models\FrontEnd\Order;

class AllOrderController extends Controller
{
    public function orderPackageSave(OrderPackageRequest $orderPackageRequest, Order $order)
{
    // Retrieve the submitted form data
    $formData = $orderPackageRequest->all();

    // Initialize an array to store the formatted boxes
    $formattedBoxes = [];
    $i = 0;
    foreach ($formData['box_number'] as $index => $boxNumber) {
        // Create a box if it doesn't exist in the formatted boxes array
        if (!isset($formattedBoxes[$boxNumber])) {
            $formattedBoxes[$boxNumber] = [
                'box_number' => $boxNumber,
                'package_weight' => $formData['package_weight'][$i] ?? null,
                'weight_unit' => $formData['weight_unit'][$i] ?? null,
                'package_length' => $formData['length'][$i] ?? null,
                'length_unit' => $formData['length_unit'][$i] ?? null,
                'package_height' => $formData['height'][$i] ?? null,
                'height_unit' => $formData['height_unit'][$i] ?? null,
                'products' => [],
            ];

            $i++;
        }

        // Add product details to the box
        $formattedBoxes[$boxNumber]['products'][] = [
            'id' => $formData['product_id'][$index] ?? null,
            'choose_product' => $formData['choose_product'][$index] ?? null,
            'name' => $formData['product_name'][$index] ?? null,
            'expected_qty' => $formData['product_expected_qty'][$index] ?? null,
        ];
    }

    // Now, $formattedBoxes contains an array of boxes with their associated product details

    // Convert $formattedBoxes to JSON
    $boxesJson = json_encode(array_values($formattedBoxes));

    // Create and save an OrderProductBox for each box
    foreach ($formattedBoxes as $index => $box) {
            $orderProductBox = new OrderProductBox();
            $orderProductBox->box_no = $box['box_number'];
            $orderProductBox->order_id =22; // You may need to adjust this depending on how the order ID is handled
            $orderProductBox->weight = $box['package_weight'];
            $orderProductBox->weight_unit = $box['weight_unit'];
            $orderProductBox->length = $box['package_length'];
            $orderProductBox->length_unit = $box['length_unit'];
            $orderProductBox->height = $box['package_height'];
            $orderProductBox->height_unit = $box['height_unit'];
            $orderProductBox->pickup_day = null; // You may need to set the pickup day
            $orderProductBox->pickup_time = null; // You may need to set the pickup time
            $orderProductBox->product_info = json_encode($box);
            $orderProductBox->save();
    }

    // Return the JSON representation of the formatted boxes if needed
    return response()->json($formattedBoxes);
}


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
