<?php

namespace App\Http\Controllers\Web\Panel\ShopSetting;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ShopSettingDistrictController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "districts";
        $this->viewPath = "admin_panel.shop_setting.district";
        $this->tableHeaders = config("tables.districts");
        $this->isFilterExists = false;
    }

    /**
     * @throws Exception
     */
    public function __invoke(): View|JsonResponse
    {
        return $this->generateView($this->viewPath);
    }
}
