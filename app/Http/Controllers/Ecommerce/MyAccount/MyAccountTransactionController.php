<?php

namespace App\Http\Controllers\Ecommerce\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyAccount\Transaction\MyAccountTransactionListRequest;
use App\Http\Resources\MyAccount\Transaction\MyAccountTransactionListResource;
use App\Models\OrderPaymentDetail;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class MyAccountTransactionController extends Controller
{
    /**
     * List
     *
     * @param MyAccountTransactionListRequest $request
     * @return JsonResponse
     */
    public function index(MyAccountTransactionListRequest $request): JsonResponse
    {
        $list = OrderPaymentDetail::getLists(OrderPaymentDetail::with(['orderPayment', 'orderPayment.order'])->whereHas('orderPayment.order', function ($query) {
            $query->where('user_id', Auth::user()->id);
        }), $request->all(), MyAccountTransactionListResource::class);

        return Message::success(null, $list);
    }
}
