<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MakePayment\MakePaymentStoreRequest;
use App\Http\Resources\AdminPanel\MakePayment\MakePaymentViewResource;
use App\Models\FrontEnd\Order;
use App\Services\OrderPaymentService;
use Illuminate\Http\JsonResponse;

class OrderPaymentController extends Controller
{
    public function __construct(private readonly OrderPaymentService $orderPaymentService) {}

    /**
     * Show
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function show(Order $order): JsonResponse
    {
        // Return a success response with the data
        return Message::success(null, MakePaymentViewResource::make($order->orderPayment));
    }

    /**
     * Store
     *
     * @param SalePaymentRequest $salePaymentRequest
     * @return JsonResponse
     */
    public function store(MakePaymentStoreRequest $makePaymentStoreRequest): JsonResponse
    {
        // Make payment
        $this->orderPaymentService->makePayment($makePaymentStoreRequest->validated());

        // Return a success message
        return Message::success(__("message.save"));
    }
}
