<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderPlaceRequest;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    /**
     * Store
     *
     * @param OrderPlaceRequest $orderPlaceRequest
     * @return JsonResponse
     */
    public function store(OrderPlaceRequest $orderPlaceRequest): JsonResponse
    {
        try {
            // Validate the request data and store the data
            $cart = $this->orderService->store($orderPlaceRequest->validated(), session('cart_info'));

            // Return a success message with the stored data
            return Message::success(__("message.save"));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex, 'SalesManController/store');
        }
    }
}
