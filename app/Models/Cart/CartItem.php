<?php

namespace App\Models\Cart;

use App\Models\Backend\Product\Product;
use App\Models\Cart;
use App\Models\CartItemCoupon;
use App\Models\ProductVariation;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class CartItem extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = ['cart_id', 'user_id', 'product_id', 'product_variation_id', 'quantity', 'is_active'];

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function productVariation(): HasOne
    {
        return $this->hasOne(ProductVariation::class, 'id', 'product_variation_id');
    }

    public function cart_item_coupon(): HasOne
    {
        return $this->hasOne(CartItemCoupon::class);
    }
}
