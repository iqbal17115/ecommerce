<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartItemCoupon extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'coupon_id',
        'cart_item_id',
        'value'
    ];
}
