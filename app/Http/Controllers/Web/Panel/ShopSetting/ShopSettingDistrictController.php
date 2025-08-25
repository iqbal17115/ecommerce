<?php

namespace App\Http\Controllers\Web\Panel\ShopSetting;

use App\Http\Controllers\Controller;
use App\Models\Address\Division;
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
        $this->isFilterExists = true;
    }

    /**
     * @throws Exception
     */
    public function index(): View|JsonResponse
    {
         $divisions = Division::select('id','name')->orderBy('name')->get();

        // Either with named args (PHP 8+):
        return $this->generateView(
            viewPath: $this->viewPath,
            model: [],
            collections: compact('divisions')
        );
    }
}
