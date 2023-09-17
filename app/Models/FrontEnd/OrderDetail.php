<?php

namespace App\Models\FrontEnd;

use App\Models\Backend\OrderProduct\OrderQuantityChange;
use App\Models\Backend\Product\ProductImage;
use App\Models\Backend\ProductInfo\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderDetail extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'quantity'
    ];

    public function orderQuantityChange()
    {
        return $this->hasMany(OrderQuantityChange::class)->orderBy('created_at', 'asc');
    }
    public function ProductMainImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'product_id');
    }
    public function Product(){
        return $this->belongsTo(Product::class);
    }
}
