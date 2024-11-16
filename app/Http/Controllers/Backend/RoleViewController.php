<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "roles";
        $this->viewPath = "backend.role.index";
        $this->tableHeaders = config("tables.roles");
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
