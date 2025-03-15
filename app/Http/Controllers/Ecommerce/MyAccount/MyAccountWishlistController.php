<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelectListRequest;
use App\Http\Resources\User\MyWishlist\MyAccountWishlistResource;
use App\Models\Frontend\Wishlist\Wishlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MyAccountWishlistController extends Controller
{
    /**
     * index
     *
     * @param SelectListRequest $request
     * @return JsonResponse
     */
    public function index(SelectListRequest $request): JsonResponse
    {
        // Get list data
        $lists = Wishlist::getAllLists(Wishlist::where('user_id', Auth::user()->id), $request->validated(), MyAccountWishlistResource::class);

        // Return a success message with the data
        return Message::success(null, $lists);
    }
}
