<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\ProductDetail;
use App\Models\Backend\Product\ProductMoreDetail;
use App\Models\Backend\Product\ProductKeyword;
use App\Models\Backend\Product\ProductCompliance;
use App\Models\Backend\Product\ProductImage;
use App\Models\FrontEnd\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
// Your other model properties and relationships go here

public function isFreeShippingEligible($totalAmount)
{
    if ($this->free_shipping === 'yes') {
        // Check if the product meets the minimum and maximum amount conditions for free shipping
        if (($this->minimum_amount_for_free_shipping === null || $totalAmount >= $this->minimum_amount_for_free_shipping)
            && ($this->maximum_amount_for_free_shipping === null || $totalAmount <= $this->maximum_amount_for_free_shipping)) {
            return true;
        }
    }

    return false;
}
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function ProductMainImage()
    {
        return $this->hasOne(ProductImage::class);
    }
    public function ProductImage()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function ProductCompliance()
    {
        return $this->hasOne(ProductCompliance::class);
    }
    public function ProductKeyword()
    {
        return $this->hasMany(ProductKeyword::class);
    }
    public function ProductMoreDetail()
    {
        return $this->hasOne(ProductMoreDetail::class);
    }
    public function ProductDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }
    public function Brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
}
