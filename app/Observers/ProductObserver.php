<?php

namespace App\Observers;

use App\Services\CacheService;
use App\Services\HomeCacheService;

class ProductObserver
{
    protected $cache;

    public function __construct()
    {
        $this->cache = app(CacheService::class);
    }

    public function saved(Product $product)
    {
        $this->cache->forgetKeys([
            'home_sliders',
            'home_top_show_categories',
            'home_product_features',
            'home_top_features',
        ]);

        app(HomeCacheService::class)->warmHomeCache();
    }

    public function deleted(Product $product)
    {
        $this->cache->forgetKeys([
            'home_sliders',
            'home_top_show_categories',
            'home_product_features',
            'home_top_features',
        ]);

        app(HomeCacheService::class)->warmHomeCache();
    }
}
