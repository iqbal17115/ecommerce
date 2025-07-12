<?php

namespace App\Http\Controllers\Backend\View;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;

class GiftCardViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "gift-cards";
        $this->viewPath = "backend.gift_cards.index";
        $this->tableHeaders = config("tables.gift_cards");
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
