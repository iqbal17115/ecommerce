<?php

namespace App\Http\Controllers\Web\Panel\Coupon;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CouponProductController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "coupon_products";
        $this->viewPath = "admin_panel.coupons.coupon_products";
        $this->tableHeaders = config("tables.coupon_products");
        $this->isFilterExists = false;
    }

    /**
     * return View
     */
    public function index(Request $request): View|JsonResponse
    {
        $coupon = Coupon::find($request->id);
        return $this->generateView($this->viewPath, $coupon);
    }
}
