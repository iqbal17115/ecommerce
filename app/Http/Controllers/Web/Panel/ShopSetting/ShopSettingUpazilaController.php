<?php

namespace App\Http\Controllers\Web\Panel\ShopSetting;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ShopSettingUpazilaController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "upazilas";
        $this->viewPath = "admin_panel.shop_setting.upazila";
        $this->tableHeaders = config("tables.upazilas");
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
