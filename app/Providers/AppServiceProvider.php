<?php

namespace App\Providers;

use App\Models\Backend\Inventory\SaleInvoice;
use App\Models\Backend\Inventory\SaleInvoiceDetail;
use App\Models\Backend\Setting\BreakingNews;
use App\Models\Backend\Setting\CompanyInfo;
use App\Models\UserProfile\ProfileSetting;
use App\Models\Backend\Setting\InvoiceSetting;
use App\Models\Backend\Setting\Language;
use App\Models\District;
use App\Models\User;
use App\Models\FrontEnd\Order;
use App\Models\Inventory\Currency;
use App\Models\Notification;
use App\Models\Backend\Offer\Offer;
use App\Models\Backend\Product\Category;
use App\Services\AddToCardService;
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
            $view->with('parentCategories', Category::whereParentCategoryId(null)->orderBy('id', 'desc')->get());
        });

        
    }
}
