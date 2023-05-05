<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\WebSetting\Advertisement;
use App\Models\Backend\WebSetting\FeatureSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    use HasFactory;
    public function TopFeatureSetting()
    {
        return $this->hasOne(FeatureSetting::class, 'product_feature_id');
    }
    public function FeatureSetting()
    {
        return $this->hasMany(FeatureSetting::class, 'parent_product_feature_id');
    }
    public function Category()
    {
        return $this->hasMany(Category::class);
    }
    public function Advertisement()
    {
        return $this->hasMany(Advertisement::class);
    }
    public function Product()
    {
        return $this->hasMany(Product::class)->take(20);
    }

}
