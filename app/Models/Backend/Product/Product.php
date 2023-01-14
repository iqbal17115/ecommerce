<?php

namespace App\Models\Backend\Product;

use App\Models\Backend\Product\Category;
use App\Models\Backend\Product\Brand;
use App\Models\Backend\Product\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function ProductImage6() {
        return $this->hasOne(ProductImage::class)->whereSerial(6);
     }
    public function ProductImage5() {
        return $this->hasOne(ProductImage::class)->whereSerial(5);
     }
    public function ProductImage4() {
        return $this->hasOne(ProductImage::class)->whereSerial(4);
     }
    public function ProductImage3() {
        return $this->hasOne(ProductImage::class)->whereSerial(3);
     }
    public function ProductImage2() {
        return $this->hasOne(ProductImage::class)->whereSerial(2);
     }
    public function ProductImage1() {
        return $this->hasOne(ProductImage::class)->whereSerial(1);
     }
    public function ProductImage0() {
        return $this->hasOne(ProductImage::class)->whereSerial(0);
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
