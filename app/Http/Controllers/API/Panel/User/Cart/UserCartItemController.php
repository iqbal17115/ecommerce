<?php

namespace App\Http\Controllers\API\Panel\User\Cart;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreCartItemRequest;
use App\Http\Resources\User\Cart\CartItemListResource;
use App\Models\Cart\CartItem;
use App\Services\UserCartService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserCartItemController extends Controller
{
    protected UserCartService $userCartService;

    public function __construct(UserCartService $userCartService)
    {
        $this->userCartService = $userCartService;
    }

    public function store(UserStoreCartItemRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();

            $this->userCartService->addToCart($data);

            if ($data['is_buy_now'] ?? false) {
                return response()->json([
                    'message' => __('messages.success_add'),
                    'redirect' => route('checkout')
                ]);
            }

            return Message::success(__('messages.success_add'), []);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 422); // 422 is common for validation-like errors
        }
    }

    public function updateQuantity(Request $request, CartItem $cartItem): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $this->userCartService->updateQuantity($cartItem, $request->quantity);

        return Message::success(__('messages.success_update'), CartItemListResource::collection(CartItem::where('id', $cartItem->id)->get()));
    }


    public function updateIsActive(Request $request, CartItem $cartItem)
    {
        $cartItem->update([
            'is_active' => !$cartItem->is_active,
        ]);

        return Message::success(__('messages.success_update'));
    }


    public function destroy(CartItem $cartItem): JsonResponse
    {
        $this->userCartService->removeItem($cartItem);

        return Message::success(__('messages.success_delete'), ['product_id' => $cartItem->product_id]);
    }
}
