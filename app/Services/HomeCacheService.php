<?php

namespace App\Services;

use App\Http\Resources\User\Home\HomeSliderResource;
use App\Http\Resources\User\Home\ProductFeature\HomePageProductFeatureResource;
use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\ProductFeature;
use App\Models\Backend\WebSetting\Slider;

class HomeCacheService
{
    protected $cache;
    protected $homePageService;

    public function __construct(CacheService $cacheService)
    {
        $this->cache = $cacheService;
        $this->homePageService = app('App\Services\HomePageService');
    }

    /**
     * Warm all homepage caches
     */
    public function warmHomeCache()
    {
        $this->cache->rememberKey('home_sliders', function () {
            return HomeSliderResource::collection(Slider::whereIsActive(1)->get());
        }, 21600);

        $this->cache->rememberKey('home_top_show_categories', function () {
            return Category::whereTopMenu(1)->whereIsActive(1)
                ->orderByRaw('ISNULL(position), position ASC')
                ->get();
        }, 21600);

        $this->cache->rememberKey('home_product_features', function () {
            return ProductFeature::getAllLists(
                $this->homePageService->getProductFeatures(),
                [],
                HomePageProductFeatureResource::class
            );
        }, 21600);

        $this->cache->rememberKey('home_top_features', function () {
            return ProductFeature::with([
                'TopFeatureSetting',
                'TopFeatureSetting.FeatureSettingDetail.Category',
                'TopFeatureSetting.ProductFeature.Advertisement',
                'Product.ProductMainImage',
                'Product.ProductImage',
                'Product.Category'
            ])
                ->whereCardFeature(1)
                ->whereTopMenu(1)
                ->whereIsActive(1)
                ->orderByRaw('ISNULL(position), position ASC')
                ->get();
        }, 21600);
    }
}
