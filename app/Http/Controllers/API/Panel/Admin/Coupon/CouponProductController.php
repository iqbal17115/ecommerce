<?php

namespace App\Http\Controllers\API\Panel\Admin\Coupon;

use App\Helpers\Message;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Coupon\CouponRequest;
use App\Http\Resources\AdminPanel\CouponProduct\CouponProductDetailResource;
use App\Traits\BaseModel;
use App\Http\Requests\AdminPanel\CouponProduct\CouponProductRequest;
use App\Http\Resources\AdminPanel\Coupon\CouponDetailResource;
use App\Http\Resources\AdminPanel\CouponProduct\CouponProductDatatableResource;
use App\Models\Coupon;
use App\Models\CouponProduct;
use App\Services\CouponProductService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CouponProductController extends Controller
{
    use BaseModel;
    protected $couponProductService;

    public function __construct(CouponProductService $couponProductService)
    {
        $this->couponProductService = $couponProductService;
    }

    public function searchProduct(Request $request)
    {
        $query = $request->input('query');

        $products = Product::where('name', 'like', '%' . $query . '%')
            ->whereNotIn('id', $request->input('existingProducts'))
            ->get();

        return response()->json($products);
    }

    /**
     * Lists
     *
     * @param Coupon $coupon
     */
    public function lists(Coupon $coupon)
    {
        try {
            return Message::success(null, CouponProductDetailResource::make($coupon));
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
            return Message::success(null, CouponProductDetailResource::make($coupon));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    /**
     * Store
     *
     * @param CouponProductRequest $couponProductRequest
     * @return JsonResponse
     */
     public function store(CouponProductRequest $couponProductRequest): JsonResponse
    {
        try {
            // Validate the couponProductRequest data and store the data
            $coupon = $this->couponProductService->store($couponProductRequest->validated());

            // Return a success message with the stored data
            return Message::success(__("message.save"));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }

    /**
     * Update
     *
     * @param CouponProductRequest $couponRequest
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function update(CouponProductRequest $couponProductRequest, Coupon $coupon): JsonResponse
    {
        // try {
            // Validate the couponRequest data and update the data
            $this->couponProductService->store($couponProductRequest->validated(), $coupon);

            // Return a success message with the updated data
            return Message::success(__("message.update"), CouponDetailResource::make($coupon));
        // } catch (Exception $ex) {
        //     // Return an error message containing the exception
        //     return $this->handleException($ex);
        // }
    }

    /**
     * Destroy
     *
     * @param Coupon $coupon
     * @return JsonResponse
     */
    public function destroy(CouponProduct $couponProduct): JsonResponse
    {
        try {
            // Delete coupon
                $couponProduct->delete();

            // Return a success message
            return Message::success(__("message.delete"));
        } catch (Exception $ex) {
            // Return an error message containing the exception
            return $this->handleException($ex);
        }
    }
}
