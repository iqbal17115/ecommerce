<?php

namespace App\Http\Controllers\Api\Panel\User\MyAccount;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MyAccountPaymentController extends Controller
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

        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }
}
