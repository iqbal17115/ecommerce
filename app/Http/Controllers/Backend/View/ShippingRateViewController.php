<?php

namespace App\Http\Controllers\Backend\View;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;

class ShippingRateViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "shipping-rates";
        $this->viewPath = "backend.shipping_rates.index";
        $this->tableHeaders = config("tables.shipping_rates");
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
