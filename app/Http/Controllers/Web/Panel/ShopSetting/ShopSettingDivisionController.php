<?php

namespace App\Http\Controllers\Web\Panel\ShopSetting;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopSettingDivisionController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "divisions";
        $this->viewPath = "admin_panel.shop_setting.division";
        $this->tableHeaders = config("tables.divisions");
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
