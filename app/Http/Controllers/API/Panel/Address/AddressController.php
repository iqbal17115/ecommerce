<?php

namespace App\Http\Controllers\API\Panel\Address;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\MyAccount\Address\AddressCreateRequest;
use App\Http\Resources\Panel\API\Address\AddressListResource;
use App\Models\Address\Address;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    use BaseModel;
    /**
     * My Address Lists
     *
     * @param Request $request
     * @return string|bool
     */
    public function myAddressList(Request $request): JsonResponse
    {
        try {
            $list = $this->getLists(Address::where('user_id', $request->user_id), $request->all(), AddressListResource::class);
            return Message::success(null, $list);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * Store Address
     *
     * @param AddressCreateRequest $addressCreateRequest
     * @return JsonResponse
     */
    public function store(AddressCreateRequest $addressCreateRequest): JsonResponse
    {
        try {
            // Address save
            Address::create($addressCreateRequest->validated());

            //Success Response
            return Message::success(__("messages.success_add"));
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
