<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Order\OrderPlaceRequest;
use App\Http\Resources\User\Checkout\Cart\CartItemListResource;
use App\Models\Cart\CartItem;
use App\Services\OrderService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class PlaceOrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService) {}

    /**
     * Store
     *
     * @param OrderPlaceRequest $orderPlaceRequest
     * @return JsonResponse
     */
    public function placeOrder(OrderPlaceRequest $orderPlaceRequest): JsonResponse
    {
        try {
            $cart = CartItem::getLists(CartItem::where('is_active', 1)->where("user_id", Auth::user()->id), $orderPlaceRequest->all(), CartItemListResource::class);

            // Validate the request data and store the data
            $order = $this->orderService->store($orderPlaceRequest->validated(), $cart);

            // Return a success message with the stored data
            return Message::success(__("messages.success_add"), $order);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return Message::error($ex->getMessage());
        }
    }
}
