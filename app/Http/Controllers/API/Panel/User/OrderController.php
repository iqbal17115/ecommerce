<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderListRequest;
use App\Http\Requests\User\Order\OrderPlaceRequest;
use App\Http\Resources\User\Order\OrderListResource;
use App\Models\FrontEnd\Order;
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


    public function lists(OrderListRequest $orderListRequest): JsonResponse
    {
            // Get list data
            $lists = Order::getLists(Order::where('user_id', $orderListRequest->user_id)->when($orderListRequest->code, function ($query) use ($orderListRequest) {
                return $query->where('code', $orderListRequest->code);
            }), $orderListRequest->validated(), OrderListResource::class);

            // Return a success message with the data
            return Message::success(null, $lists);

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
            $order = $this->orderService->store($orderPlaceRequest->validated(), session('cart_info'));

            // Return a success message with the stored data
            return Message::success(__("messages.success_add"), $order);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return Message::error($ex->getMessage());
        }
    }
}
