<?php

namespace App\Http\Controllers\Backend\View;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;

class ShippingZoneViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "shipping-zones.view";
        $this->viewPath = "backend.shipping_zones.index";
        $this->tableHeaders = config("tables.shipping_zones");
        $this->isFilterExists = false;
    }

    /**
     * @throws Exception
     */
    public function index()
    {
        return $this->generateView($this->viewPath);
    }
}
