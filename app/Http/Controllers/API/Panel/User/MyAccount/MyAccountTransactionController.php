<?php

namespace App\Http\Controllers\Api\Panel\User\MyAccount;

use App\Enums\OrderStatusEnum;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\MyAccount\MyTransactionListResource;
use App\Models\Backend\Order\OrderTracking;
use App\Models\FrontEnd\Order;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyAccountTransactionController extends Controller
{
    use BaseModel;

    /**
     * My Group Lists
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        try {
            $query = OrderTracking::with(['order' => function ($query) {
                $query->where('user_id', Auth::user()->id)
                      ->orderByRaw("status = '" . OrderStatusEnum::COMPLETED . "' DESC, code DESC");
            }])
            ->whereIn('status', [OrderStatusEnum::COMPLETED, OrderStatusEnum::REFUNDED])
            ->orderBy('created_at', 'asc');

            $list = $this->getLists($query, $request->all(), MyTransactionListResource::class);

            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

}
