<?php

namespace App\Providers;

use App\Models\Backend\Currency\Currency;
use App\Models\Backend\Product\Category;
use App\Models\Backend\WebSetting\Advertisement;
use App\Models\Backend\WebSetting\CompanyInfo;
use App\Services\CacheService;
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
    public function register() {}

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
            $cacheService = app(CacheService::class);
            $parentCategories = $cacheService->remember('parentCategories', function () {
                return Category::whereParentCategoryId(null)
                    ->whereTopMenu(1)
                    ->orderBy('position', 'asc')
                    ->get();
            }, 3600);

            $sidebarMenuCategories = $cacheService->remember('sidebarMenuCategories', function () {
                return Category::whereSidebarMenu(1)
                    ->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')
                    ->get();
            }, 3600);

            $headerMenuCategories = $cacheService->remember('headerMenuCategories', function () {
                return Category::whereHeaderMenu(1)
                    ->orderByRaw('ISNULL(header_menu_position), header_menu_position ASC')
                    ->limit(6)
                    ->get();
            }, 3600);

            $allActiveAdvertisements = $cacheService->remember('allActiveAdvertisements', function () {
                return Advertisement::orderBy('position')
                    ->whereIsActive(1)
                    ->get()
                    ->groupBy('page')
                    ->map(function ($ads, $page) {
                        return collect($ads)->keyBy('position');
                    })
                    ->toArray();
            }, 3600);

            $company_info = $cacheService->remember('companyInfo', function () {
                return CompanyInfo::first();
            }, 3600);

            $currency = $cacheService->remember('currency', function () {
                return Currency::whereIsDefault(1)->first();
            }, 3600);

            $view->with(compact(
                'parentCategories',
                'sidebarMenuCategories',
                'headerMenuCategories',
                'allActiveAdvertisements',
                'company_info',
                'currency'
            ));
        });
    }
}
