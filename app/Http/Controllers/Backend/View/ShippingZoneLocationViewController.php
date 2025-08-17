<?php

namespace App\Http\Controllers\Backend\View;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;

class ShippingZoneLocationViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "shipping-zone-locations.view";
        $this->viewPath = "backend.shipping_zone_locations.index";
        $this->tableHeaders = config("tables.shipping_zone_locations");
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
