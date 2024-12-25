<?php

namespace App\Http\Controllers\Backend\Order;

use App\Enums\LengthUnitEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\FrontEnd\Order;
use App\Models\FrontEnd\OrderDetail;
use App\Services\OrderService;
use App\Traits\Barcode;
use App\Traits\BaseModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class OrderController extends Controller
{
    use BaseModel, Barcode;

    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    
    public function generateBarcodes(Request $request)
    {
        // Get the barcode content array from the request
        $contents = $request->product_codes;

        // Create an array to store barcode data (image and content)
        $barcodesData = [];

        foreach ($contents as $content) {
            // Generate the barcode image using the function you provided
            $barcodeImage = $this->generateBarcodeImageFromString($content);

            // Store barcode image and content
            $barcodesData[] = [
                'image' => $barcodeImage,
                'content' => $content,
            ];
        }

        // Set the appropriate response headers for the images
        return response()->view('barcodes', ['barcodesData' => $barcodesData]);
    }
    public function orderData(Request $request)
    {
        $query = Order::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start_date = Carbon::createFromFormat('Y-m-d', $request->input('start_date'))->startOfDay();
            $end_date = Carbon::createFromFormat('Y-m-d', $request->input('end_date'))->endOfDay();

            $query->whereBetween('order_date', [$start_date, $end_date]);
        }

        return $this->dataTable($query, $request->all(), OrderResource::class);
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
        $lengthUnits = LengthUnitEnum::getOptions();
        return view('backend.order.confirm-order', compact('order', 'lengthUnits'));
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

    public function partiallyShippedOrderPage()
    {
        return view('backend.order.partially-shipped');
    }

    public function backorderedOrderPage()
    {
        return view('backend.order.backordered');
    }

    public function preOrderOrderPage()
    {
        return view('backend.order.pre-order');
    }

    public function refundedOrderPage()
    {
        return view('backend.order.refunded');
    }

    public function returnedOrderPage()
    {
        return view('backend.order.returned');
    }

    public function cancelledOrderPage()
    {
        return view('backend.order.cancelled');
    }

    public function failedOrderPage()
    {
        return view('backend.order.failed');
    }

    public function holdOrderPage()
    {
        return view('backend.order.hold');
    }

    public function completedOrderPage()
    {
        return view('backend.order.completed');
    }

    public function paymentCollectedOrderPage()
    {
        return view('backend.order.payment-collected');
    }

    public function deliveredOrderPage()
    {
        return view('backend.order.delivered');
    }

    public function deliveryReschedulingOrderPage()
    {
        return view('backend.order.delivery-rescheduling');
    }

    public function deliveryAttemptedOrderPage()
    {
        return view('backend.order.delivery-attempted');
    }

    public function outForDeliveryOrderPage()
    {
        return view('backend.order.out-for-delivery');
    }

    public function arrivalAtDistributionCenterOrderPage()
    {
        return view('backend.order.arrival-at-distribution-center');
    }

    public function inTransitOrderPage()
    {
        return view('backend.order.in-transit-order');
    }

    public function shippedOrderPage()
    {
        return view('backend.order.shipped-order');
    }

    public function newOrderPage()
    {
        return view('backend.order.new-order');
    }

    public function pendingOrderPage()
    {
        return view('backend.order.pending-order');
    }
}
