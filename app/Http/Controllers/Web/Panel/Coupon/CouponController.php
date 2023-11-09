<?php

namespace App\Http\Controllers\Web\Panel\Coupon;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class CouponController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "coupons";
        $this->viewPath = "admin_panel.coupons.coupons";
        $this->tableHeaders = config("tables.coupons");
        $this->isFilterExists = false;
    }

    /**
     * return View
     */
    public function index(): View|JsonResponse
    {
        return $this->generateView($this->viewPath);
    }
}
