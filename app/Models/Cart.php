<?php

namespace App\Models;

use App\Models\Cart\CartItem;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'user_id', 'coupon_id', 'coupon_discount', 'subtotal', 'total', 'is_active'
    ];

    // Define the relationship to CartItems
    public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}
