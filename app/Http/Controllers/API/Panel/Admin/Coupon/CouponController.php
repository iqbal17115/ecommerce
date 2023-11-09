<?php

namespace App\Http\Controllers\API\Panel\Admin\Coupon;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Coupon\CouponListRequest;
use App\Http\Requests\AdminPanel\Coupon\CouponRequest;
use App\Http\Resources\AdminPanel\Coupon\CouponDetailResource;
use App\Http\Resources\AdminPanel\Coupon\CouponDatatableResource;
use App\Models\Coupon;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    use BaseModel;
    /**
     * Lists
     *
     * @param Request $request
     * @return string|bool
     */
    public function lists(Request $request): bool|string
    {
        try {
            return $this->dataTable(Coupon::query(), $request->all(), CouponDatatableResource::class);
        } catch (Exception $ex) {
            return Message::error($ex->getMessage());
        }
    }

    /**
     * index
     *
     * @param CouponListRequest $couponListRequest
     * @return JsonResponse
     */
    public function index(CouponListRequest $couponListRequest): JsonResponse
    {
        try {
            // Get list data
            $lists = Coupon::getLists(Coupon::query(), $couponListRequest->validated(), CouponListResource::class);
            // Return a success message with the data
            return Message::success(null, $lists);
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    /**
     * Show
     *
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function show(Coupon $coupon): JsonResponse
    {
        try {
            // Return a success response with the data
            return Message::success(null, CouponDetailResource::make($coupon));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    /**
     * Store
     *
     * @param CouponRequest $couponRequest
     * @return JsonResponse
     */
    public function store(CouponRequest $couponRequest): JsonResponse
    {
        try {
            // Validate the couponRequest data and store the data
            $coupon = Coupon::create($couponRequest->validated());

            // Return a success message with the stored data
            return Message::success(__("message.save"), CouponDetailResource::make($coupon));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    /**
     * Update
     *
     * @param CouponRequest $couponRequest
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function update(CouponRequest $couponRequest, Coupon $coupon): JsonResponse
    {
        try {
            // Validate the couponRequest data and update the data
            $coupon->update($couponRequest->validated());

            // Return a success message with the updated data
            return Message::success(__("message.update"), CouponDetailResource::make($coupon));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    /**
     * Destroy
     *
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function destroy(Coupon $coupon): JsonResponse
    {
        try {
            // Delete coupon
            $coupon->delete();

            // Return a success message
            return Message::success(__("message.delete"));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }
}
