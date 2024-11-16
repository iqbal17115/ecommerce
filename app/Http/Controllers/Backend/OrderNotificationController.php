<?php

namespace App\Http\Controllers\Backend;

use App\Enums\OrderStatusEnum;
use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Resources\OrderNotification\OrderNotificationListResource;
use App\Models\FrontEnd\Order;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderNotificationController extends Controller
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

            $list = $this->getLists(Order::where('status', OrderStatusEnum::PENDING), $request->all(), OrderNotificationListResource::class);

            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
