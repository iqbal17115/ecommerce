<?php

namespace App\Providers;

use App\Models\Backend\Currency\Currency;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Product;
use App\Models\Backend\WebSetting\Advertisement;
use App\Models\Backend\WebSetting\CompanyInfo;
use App\Observers\ProductObserver;
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

        //Products Observer
        Product::observe(ProductObserver::class);

        //Categories
        View::composer('*', function ($view) {
            $cacheService = app(CacheService::class);
            $parentCategories = $cacheService->remember('parentCategories', function () {
                return Category::whereParentCategoryId(null)
                    ->whereTopMenu(1)
                    ->orderBy('position', 'asc')
                    ->get();
            }, 21600);

            $sidebarMenuCategories = $cacheService->remember('sidebarMenuCategories', function () {
                return Category::whereSidebarMenu(1)
                    ->orderByRaw('ISNULL(sidebar_menu_position), sidebar_menu_position ASC')
                    ->get();
            }, 21600);

            $headerMenuCategories = $cacheService->remember('headerMenuCategories', function () {
                return Category::whereHeaderMenu(1)
                    ->orderByRaw('ISNULL(header_menu_position), header_menu_position ASC')
                    ->limit(6)
                    ->get();
            }, 21600);

            $allActiveAdvertisements = $cacheService->remember('allActiveAdvertisements', function () {
                return Advertisement::orderBy('position')
                    ->whereIsActive(1)
                    ->get()
                    ->groupBy('page')
                    ->map(function ($ads, $page) {
                        return collect($ads)->keyBy('position');
                    })
                    ->toArray();
            }, 21600);

            $company_info = $cacheService->remember('company_info', function () {
                return CompanyInfo::first();
            }, 21600);

            $currency = $cacheService->remember('currency', function () {
                return Currency::whereIsDefault(1)->first();
            }, 21600);

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
