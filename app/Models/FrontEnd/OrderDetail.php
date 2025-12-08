<?php

namespace App\Models\FrontEnd;

use App\Models\Backend\OrderProduct\OrderQuantityChange;
use App\Models\Backend\Product\ProductImage;
use App\Models\ProductVariation;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderDetail extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'order_id',
        'product_id',
        'product_variation_id',
        'unit_price',
        'quantity',
        'return_quantity',
        'return_reason',
        'return_status',
        'is_active'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function productVariation(): HasOne
    {
        return $this->hasOne(ProductVariation::class, 'id', 'product_variation_id');
    }

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
