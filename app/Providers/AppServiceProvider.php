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
          

        });
    }
}
