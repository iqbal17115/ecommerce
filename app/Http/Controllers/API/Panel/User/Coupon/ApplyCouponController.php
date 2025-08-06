<?php

namespace App\Http\Controllers\API\Panel\User\Coupon;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\Coupon\ApplyCouponRequest;
use App\Services\ApplyCouponProductService;
use App\Traits\BaseModel;
use Exception;
use Illuminate\Http\JsonResponse;

class ApplyCouponController extends Controller
{
    protected $applyCouponProductService;

    public function __construct(ApplyCouponProductService $applyCouponProductService)
    {
        $this->applyCouponProductService = $applyCouponProductService;
    }

    /**
     * Apply coupon
     *
     * @param ApplyCouponRequest $applyCouponRequest
     * @return JsonResponse
     */
    public function apply(ApplyCouponRequest $applyCouponRequest): JsonResponse
    {
        try {
            // Apply coupon
            $applyCoupon = $this->applyCouponProductService->applyCoupon($applyCouponRequest->validated());

            //Success Response
            return Message::success($applyCoupon);
        } catch (Exception $e) {
            // Handle any exception that occurs during the process
            return Message::error($e->getMessage());
        }
    }
}
