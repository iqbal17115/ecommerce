<?php

namespace App\Http\Controllers\API\Panel\User\Cart;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Cart\AddToCartRequest;
use App\Http\Requests\User\Cart\UpdateAllCartItemStatusRequest;
use App\Http\Requests\User\Cart\UpdateCartItemRequest;
use App\Http\Requests\User\Cart\UpdateCartItemStatusRequest;
use App\Http\Resources\User\Cart\CartItemDetailResource;
use App\Http\Resources\User\Cart\CartItemListResource;
use App\Http\Resources\User\Checkout\Cart\CartItemListResource as CartCartItemListResource;
use App\Models\Cart\CartItem;
use App\Services\CartService;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    use BaseModel;
    protected $cartService;

    public function updateCartItemStatus(UpdateCartItemStatusRequest $updateCartItemStatusRequest, CartItem $cartItem) {
        try {
            $cartItem->update(['is_active' => $updateCartItemStatusRequest->is_checked ? 1 : 0]);
            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    public function updateCartAllItemStatus(UpdateAllCartItemStatusRequest $updateAllCartItemStatusRequest) {
        try {

            CartItem::where('user_id', $updateAllCartItemStatusRequest->user_id)
            ->update(['is_active' => $updateAllCartItemStatusRequest->is_checked]);

            //Success Response
            return Message::success(__("messages.success_update"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function addToCartBuyNowWithQuantity(AddToCartRequest $addToCartRequest)
    {
        try {
            $cartItem = $this->cartService->byNowWithQuantity($addToCartRequest->user_id, $addToCartRequest->product_id, $addToCartRequest->quantity);

            return Message::success(__("messages.success_add"), new CartItemDetailResource($cartItem));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    public function addToCartWithQuantity(AddToCartRequest $addToCartRequest)
    {
        try {
            $cartItem = $this->cartService->addToCartWithQuantity($addToCartRequest->user_id, $addToCartRequest->product_id, $addToCartRequest->quantity, $addToCartRequest->product_variation_id);

            return Message::success(__("messages.success_add"), new CartItemDetailResource($cartItem));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    public function addToCart(AddToCartRequest $addToCartRequest)
    {
        try {
            $cartItem = $this->cartService->addToCart($addToCartRequest->user_id, $addToCartRequest->product_id, $addToCartRequest->quantity);

            return Message::success(__("messages.success_add"), new CartItemDetailResource($cartItem));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    public function getCart(Request $request)
    {
        $cart = $this->getLists(CartItem::with('productVariation', 'productVariation.productVariationAttributes', 'productVariation.productVariationAttributes.attributeValue')->where("user_id", $request->user_id), $request->all(), CartItemListResource::class);

        return Message::success(null, $cart);
    }

    public function updateCartItem(UpdateCartItemRequest $updateCartItemRequest, CartItem $cartItem)
    {
        $cartItem->update(['quantity' => $updateCartItemRequest->quantity]);

        return Message::success(__("messages.success_add"), new CartItemDetailResource($cartItem));
    }

    public function removeCartItem(CartItem $cartItem)
    {
        try {
            $cartItem->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }

    public function getCheckoutCart(Request $request)
    {
        $cart = $this->getLists(CartItem::where('is_active', 1)->where("user_id", $request->user_id), $request->all(), CartCartItemListResource::class);
        session(['cart_info' => $cart]);
        return Message::success(null, $cart);
    }
}
