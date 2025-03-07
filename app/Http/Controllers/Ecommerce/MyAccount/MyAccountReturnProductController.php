<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyAccount\ReturnProduct\MyAccountReturnProductOrderListRequest;
use App\Http\Resources\MyAccount\ReturnProduct\MyAccountReturnProductOrderListResource;
use App\Models\FrontEnd\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MyAccountReturnProductController extends Controller
{
    /**
     * index
     *
     * @param MyAccountReturnProductOrderListRequest $request
     * @return JsonResponse
     */
    public function index(MyAccountReturnProductOrderListRequest $request): JsonResponse
    {
        // Get list data
        $lists = Order::getLists(Order::where('user_id', Auth::user()->id), $request->validated(), MyAccountReturnProductOrderListResource::class);

        // Return a success message with the data
        return Message::success(null, $lists);
    }
}
