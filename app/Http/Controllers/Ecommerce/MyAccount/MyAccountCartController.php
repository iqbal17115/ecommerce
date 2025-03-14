<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\SelectListRequest;
use App\Http\Resources\User\MyCart\MyCartItemResource;
use App\Models\Cart\CartItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MyAccountCartController extends Controller
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
        $lists = CartItem::getAllLists(CartItem::where('user_id', Auth::user()->id), $request->validated(), MyCartItemResource::class);

        // Return a success message with the data
        return Message::success(null, $lists);
    }
}
