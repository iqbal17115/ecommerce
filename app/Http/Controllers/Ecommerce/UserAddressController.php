<?php

namespace App\Http\Controllers\Ecommerce;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserAddress\StoreOrUpdateUserAddressRequest;
use App\Http\Resources\User\UserAddress\StoreOrUpdateUserAddressResource;
use App\Http\Resources\User\UserAddress\UserAddressListResource;
use App\Http\Resources\User\UserAddress\UserAddressResource;
use App\Models\UserAddress;
use App\Services\UserAddressService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    public function __construct(private readonly UserAddressService $service) {}

   /**
     * My Address Lists
     *
     * @param Request $request
     * @return string|bool
     */
    public function list(Request $request): JsonResponse
    {
            $list = UserAddress::getLists(UserAddress::where('user_id', Auth::user()->id)->orderByDesc('is_default'), $request->all(), UserAddressListResource::class);
            return Message::success(null, $list);
    }

    public function storeOrUpdate(StoreOrUpdateUserAddressRequest $request)
    {
        $addressId = $request->input('address_id');

        $address = $this->service->storeOrUpdate($request->validated(), $addressId);
        return Message::success(null, StoreOrUpdateUserAddressResource::make($address));
    }

    public function show($id)
    {
        $address = UserAddress::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return new UserAddressResource($address);
    }
}
