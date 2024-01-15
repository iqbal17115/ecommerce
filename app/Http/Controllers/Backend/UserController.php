<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __invoke(): View|JsonResponse
    {
        $roles = Role::where('type', RoleTypeEnum::GLOBAL())->get();
        return $this->generateView($this->viewPath, $roles);
    }
}
