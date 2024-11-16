<?php

namespace App\Http\Controllers\Backend;

use App\Enums\RoleTypeEnum;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Traits\BaseModel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserViewController extends Controller
{
    use BaseModel;

    public function __construct()
    {
        parent::__construct();

        $this->mainRoute = "users";
        $this->viewPath = "backend.role.users";
        $this->tableHeaders = config("tables.users");
        $this->isFilterExists = false;
    }
    public function __invoke(): View|JsonResponse
    {
        $roles = Role::where('type', RoleTypeEnum::GLOBAL);
        return $this->generateView($this->viewPath, $roles);
    }
}
