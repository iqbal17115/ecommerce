<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Helpers\SessionHelper;
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
            $userId = Auth::id();
            $sessionId = SessionHelper::getSessionId();

            $cart = CartItem::getLists(CartItem::where('is_active', 1)->where(function ($q) use ($userId, $sessionId) {
                $q->where('session_id', $sessionId);

                if ($userId) {
                    $q->orWhere('user_id', $userId);
                }
            }), $orderPlaceRequest->all(), CartItemListResource::class);

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
