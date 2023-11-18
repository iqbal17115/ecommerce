<?php

namespace App\Http\Controllers\API\Panel\User\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\MyAccount\Wishlist\MyAccountWishlistResource;
use App\Models\Frontend\Wishlist\Wishlist;
use App\Services\CartService;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyAccountWishlistController extends Controller
{
    use BaseModel;
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    /**
     * Update
     *
     * @param Request $request
     * @param Wishlist $wishlist
     * @return JsonResponse
     */
    public function wishlistToCart(Request $request, Wishlist $wishlist): JsonResponse
    {
        try {
            $cartItem = $this->cartService->addToCart($wishlist->user_id, $wishlist->product_id, 1);
            $wishlist->delete();
            // Return a success message with the updated data
            return Message::success(__("message.update"));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    public function list(Request $request)
    {
        $wishlist = $this->getLists(Wishlist::where("user_id", $request->user_id), $request->all(), MyAccountWishlistResource::class);
        return Message::success(null, $wishlist);
    }

    public function removeWishlist(Wishlist $wishlist)
    {
        try {
            $wishlist->delete();

            //Success Response
            return Message::success(__("messages.success_delete"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
