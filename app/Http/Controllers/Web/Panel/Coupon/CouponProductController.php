<?php

namespace App\Http\Controllers\Web\Panel\Coupon;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;
use App\Models\Backend\Product\Product;
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
    public function index(): View|JsonResponse
    {
        $product_lists = Product::get();
        return $this->generateView($this->viewPath, $product_lists);
    }
}
