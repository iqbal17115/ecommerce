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
use App\Http\Requests\Order\OrderCancelRequest;
use App\Http\Requests\Order\OrderFulfilmentNoteRequest;
use App\Http\Requests\Order\OrderNoteRequest;
use App\Http\Requests\Order\OrderPackageRequest;
use App\Http\Requests\Order\OrderPaymentNoteRequest;
use App\Http\Requests\Order\OrderPaymentRequest;
use App\Http\Requests\Order\OrderPaymentStatusRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\Order\OrderStatusRequest;
use App\Models\Backend\Order\OrderTracking;
use App\Models\Backend\OrderProduct\OrderNoteStatus;
use App\Models\Backend\OrderProduct\OrderProductBox;
use App\Models\FrontEnd\Order;
use App\Models\OrderAddress;
use App\Models\OrderPayment;
use App\Services\AdvanceEditOrderService;
use App\Services\OrderPaymentService;
use App\Traits\Barcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AllOrderController extends Controller
{
    use Barcode;

    private $advanceEditOrderService;
    private $orderPaymentService;

    public function __construct(AdvanceEditOrderService $advanceEditOrderService, OrderPaymentService $orderPaymentService)
    {
        $this->advanceEditOrderService = $advanceEditOrderService;
        $this->orderPaymentService = $orderPaymentService;
    }

    public function createUpdateStatus(OrderStatusRequest $orderStatusRequest, Order $order)
    {
        $response = $this->advanceEditOrderService->createUpdateStatus($orderStatusRequest, $order);

        return $response;
    }

    public function generatePackageBarcodes(Order $order)
    {

        // Create an array to store barcode data (image and content)
        $barcodesData = [];
        $barcodeOrderImage = $this->generatePackageBarcodeImageFromString($order->code);

        foreach ($order->orderProductBox as $product_box) {
            // Generate the barcode image using the function you provided
            $box_no = $order->code . 'B' . $product_box->box_no;
            $barcodeImage = $this->generatePackageBarcodeImageFromString($box_no);

            // Store barcode image and content
            $barcodesData[] = [
                'image' => $barcodeImage,
                'content' => $box_no,
                'box_no' => $product_box->box_no,
                'pickup_day' => $product_box->pickup_day,
                'pickup_time' => $product_box->pickup_time,
            ];
        }

        $user = Auth::user();
        // Set the appropriate response headers for the images
        return response()->view('backend.order.pachage_barcodes', ['barcodesData' => $barcodesData, 'order' => $order, 'barcodeOrderImage' => $barcodeOrderImage]);
    }

    public function orderPackageSave(OrderPackageRequest $orderPackageRequest, Order $order)
    {
        $order->status = 'processing';
        $order->save(); // update order status

        $order = OrderTracking::updateOrCreate(
            [
                'order_id' => $order->id,
                'status' => 'processing',
            ],
            [
                'status' => 'processing',
                'created_by' => Auth::user()->id
            ],
        );


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

        // Convert $formattedBoxes to JSON
        $boxesJson = json_encode(array_values($formattedBoxes));

        // Create and save an OrderProductBox for each box
        foreach ($formattedBoxes as $index => $box) {
            $orderProductBox = OrderProductBox::firstOrNew([
                'order_id' => $orderPackageRequest->order_id['0'],
                'box_no' => $box['box_number'],
            ]);
            $orderProductBox->box_no = $box['box_number'];
            $orderProductBox->order_id = $orderPackageRequest->order_id['0'];
            $orderProductBox->weight = $box['package_weight'];
            $orderProductBox->weight_unit = $box['weight_unit'];
            $orderProductBox->length = $box['package_length'];
            $orderProductBox->length_unit = $box['length_unit'];
            $orderProductBox->height = $box['package_height'];
            $orderProductBox->height_unit = $box['height_unit'];
            $orderProductBox->pickup_day = $formData['pickup_day']; // You may need to set the pickup day
            $orderProductBox->pickup_time = $formData['pickup_time']; // You may need to set the pickup time
            $orderProductBox->product_info = json_encode($box);
            $orderProductBox->save();
        }

        return response()->json(
            [
                'message' => 'Payment note saved',
                'order_id' => $orderPackageRequest->order_id['0']
            ],
            200
        );
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

        // Call the handleOrderPaymentStatus method
        $this->orderPaymentService->handleOrderPaymentStatus($order, $orderPaymentStatusRequest->input('payment_status'));

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
        $this->advanceEditOrderService->store($order);
        $order->status = 'processing';
        $order->save();

        $order = OrderTracking::updateOrCreate(
            [
                'order_id' => $order->id,
                'status' => 'processing',
            ],
            [
                'status' => 'processing',
                'created_by' => Auth::user()->id
            ],
        );


        $data = [
            'status' => "processing"
        ];

        return response()->json([
            'message' => 'Order confirmed successfully',
            'data' => $data
        ], 200);
    }

    public function cancelOrder(OrderCancelRequest $orderCancelRequest, Order $order)
    {
        DB::transaction(function () use ($orderCancelRequest, $order) {
            $this->advanceEditOrderService->cancelOrder($orderCancelRequest, $order);
        });

        return response()->json([
            'message' => 'Order canceled successfully',
            'data' => $this->advanceEditOrderService->getOrderAndSaleData($orderCancelRequest)
        ], 200);
    }

    public function advanceEdit(Request $request)
    {
        $order = Order::with(['courierShipment'])->find($request->id);
        $lengthUnits = LengthUnitEnum::getOptions();
        $weightUnits = WeightUnitEnum::getWeightOptions();
        $cancel_reasons = ProductCancelReasonEnum::getCancelOptions();
        $reflectionClass = new \ReflectionClass(OrderStatusEnum::class);
        $orderStatuses = array_values($reflectionClass->getConstants());
        $paymentStatuses = PaymentStatusEnum::getValues();
        $paymentTypes = PaymentTypeEnum::getPaymentTypes();
        $paymentMethods = PaymentMethodEnum::getValues();

        return view('backend.order.advance-edit', compact('order', 'lengthUnits', 'weightUnits', 'cancel_reasons', 'orderStatuses', 'paymentStatuses', 'paymentTypes', 'paymentMethods'));
    }

    public function updateOrderAddress(Request $request)
    {
        $validated = $request->validate([
            'address_id' => 'required|uuid|exists:order_addresses,id',
            'name' => 'required|string|max:50',
            'mobile' => 'required|string',
            'street_address' => 'required|string',
            'country_name' => 'required|string',
            'division_name' => 'required|string',
            'district_name' => 'required|string',
            'upazila_name' => 'required|string',
            'type' => 'required|in:home,office',
        ]);

        $address = OrderAddress::find($request->address_id);
        $address->update($validated);

        return response()->json(['orderAddress' => $address]);
    }


    public function index()
    {
        $reflectionClass = new \ReflectionClass(OrderStatusEnum::class);
        $statusValues = array_values($reflectionClass->getConstants());
        return view('backend.order.all-order', compact('statusValues'));
    }
}
