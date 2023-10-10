<?php

namespace App\Http\Controllers\Web\Panel\ShopSetting;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ShopSettingCountryController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "countries";
        $this->viewPath = "admin_panel.shop_setting.country";
        $this->tableHeaders = config("tables.countries");
        $this->isFilterExists = false;
    }

    /**
     * @throws Exception
     */
    public function index(): View|JsonResponse
    {
        return $this->generateView($this->viewPath);
    }
}
