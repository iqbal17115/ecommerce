<?php

namespace App\Http\Controllers\Backend\View;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;

class RewardPointRuleViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "reward-points";
        $this->viewPath = "backend.reward_points.index";
        $this->tableHeaders = config("tables.reward_point_rules");
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
