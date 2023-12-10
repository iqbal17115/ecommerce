<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderPlaceRequest;
use App\Services\OrderService;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    use BaseModel;
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
        dd($orderPlaceRequest->validated());
        try {
            // Validate the request data and store the data
            $order = $this->orderService->store($orderPlaceRequest->validated(), session('cart_info'));

            // Return a success message with the stored data
            return Message::success(__("messages.success_add"), $order);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return Message::error($ex->getMessage());
        }
    }
}
