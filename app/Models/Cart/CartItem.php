<?php

namespace App\Models\Cart;

use App\Models\Backend\Product\Product;
use App\Models\CartItemCoupon;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Model
{
    use HasFactory, BaseModel;
    protected $fillable = ['user_id', 'product_id', 'quantity', 'is_active'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function cart_item_coupon(): HasOne
    {
        return $this->hasOne(CartItemCoupon::class);
    }
}
