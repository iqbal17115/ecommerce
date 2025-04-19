<?php

namespace App\Http\Controllers\API\Panel\User\Cart;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreCartItemRequest;
use App\Models\Cart\CartItem;
use App\Services\UserCartService;
use Illuminate\Http\JsonResponse;

class UserCartItemController extends Controller
{
    protected UserCartService $userCartService;

    public function __construct(UserCartService $userCartService)
    {
        $this->userCartService = $userCartService;
    }

    public function store(UserStoreCartItemRequest $request): JsonResponse
    {
        $data = $request->validated();

        $this->userCartService->addToCart($data);

        if ($data['is_buy_now'] ?? false) {
            return response()->json([
                'message' => __('messages.success_add'),
                'redirect' => route('checkout') // you define this route
            ]);
        }

        return Message::success(__('messages.success_add'), []);
    }

    public function destroy(CartItem $cartItem): JsonResponse
    {

        $this->userCartService->removeItem($cartItem);

        return Message::success(__('messages.success_delete'));
    }
}
