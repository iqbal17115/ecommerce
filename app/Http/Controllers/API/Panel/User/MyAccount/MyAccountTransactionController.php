<?php

namespace App\Http\Controllers\API\Panel\User\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\MyAccount\MyTransactionListResource;
use App\Models\OrderPayment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $list = OrderPayment::getLists(OrderPayment::whereHas('order', function ($query) {
            $query->where('user_id', Auth::user()->id);
        }), $request->all(), MyTransactionListResource::class);

        return Message::success(null, $list);
    }
}
