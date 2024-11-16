<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected string $breadcrumbTitle;
    protected string $mainRoute;
    protected string $viewPath;
    protected string $viewManageGroupPath;
    protected string $viewMemberProfilePath;
    protected string $viewGroupDetailsPath;
    protected string $viewMyGroupFeedsPath;
    protected string $viewGroupMembersPath;
    protected string $viewGroupAboutPath;
    protected string $formPath;
    protected string $groupCreateUpdatePath;
    protected array $tableHeaders;
    protected bool $isFilterExists;
    
    public function __construct()
    {

    }
}
