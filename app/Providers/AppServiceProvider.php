<?php

namespace App\Providers;

use App\Models\Backend\Currency\Currency;
use App\Models\Backend\Product\Category;
use App\Models\Backend\WebSetting\Advertisement;
use App\Models\Backend\WebSetting\CompanyInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        //Categories
        View::composer('*', function ($view) {
            $view->with('parentCategories', Category::whereParentCategoryId(null)->whereTopMenu(1)->orderBy('position', 'asc')->get());
            $view->with('sidebarMenuCategories', Category::whereSidebarMenu(1)->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')->get());
            $view->with('headerMenuCategories', Category::whereHeaderMenu(1)->orderByRaw('ISNULL(header_menu_position), header_menu_position ASC')->get());
            $view->with('all_active_advertisements', Advertisement::orderBy('position')->whereIsActive(1)
            ->get()
            ->groupBy('page')
            ->map(function ($ads, $page) {
                return collect($ads)->keyBy('position');
            })
            ->toArray());
            $view->with('company_info', CompanyInfo::first());
            $view->with('currency', Currency::whereIsDefault(1)->first());
        });

        
    }
}
