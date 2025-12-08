<?php

namespace App\Models;

use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\Category;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait, SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'product_feature_id',
        'brand_id',
        'category_id',
        'description',
        'short_description',
        'highlights',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function productCombinations()
    {
        return $this->hasMany(ProductCombination::class);
    }

    public function productSpecs()
    {
        return $this->hasMany(ProductSpec::class);
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function featureImage()
    {
        return $this->media()->where('type', 'feature')->first();
    }

    public function gallery()
    {
        return $this->morphMany(Media::class, 'mediable')->where('type', 'gallery')->orderBy('sort_order');
    }

    public function promoImage()
    {
        return $this->media()->where('type', 'promo')->first();
    }
}
