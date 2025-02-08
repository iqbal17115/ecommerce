<?php

namespace App\Http\Controllers\API\Panel\User;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderDetailRequest;
use App\Http\Requests\User\Order\OrderListRequest;
use App\Http\Requests\User\Order\OrderPlaceRequest;
use App\Http\Resources\User\Order\OrderListResource;
use App\Http\Resources\User\Checkout\Cart\CartItemListResource as CartCartItemListResource;
use App\Http\Resources\User\OrderDetail\OrderResource;
use App\Models\Cart\CartItem;
use App\Models\FrontEnd\Order;
use App\Services\OrderService;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

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
            return $query->where('code', 'like', '%' . $orderListRequest->code . '%');
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
            $cart = $this->getLists(CartItem::where('is_active', 1)->where("user_id", $orderPlaceRequest->user_id), $orderPlaceRequest->all(), CartCartItemListResource::class);
            
            // Validate the request data and store the data
            $order = $this->orderService->store($orderPlaceRequest->validated(), $cart);

            // Return a success message with the stored data
            return Message::success(__("messages.success_add"), $order);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Show
     *
     * @param OrderDetailRequest $orderDetailRequest
     * @return JsonResponse
     */
    public function orderDetails(OrderDetailRequest $orderDetailRequest): JsonResponse
    {
        try {
            // Get the order details
            $order = Order::where('user_id', Auth::user()->id)->where('code', $orderDetailRequest->order_code)->first();

            // Return a success message with the order details
            return Message::success(__("messages.success_add"), OrderResource::make($order));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return Message::error($ex->getMessage());
        }
    }
}
