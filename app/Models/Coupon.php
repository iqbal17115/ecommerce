<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $table = 'coupons';
    
    protected $fillable = [
        'code',
        'description',
        'type',
        'value',
        'max_uses',
        'valid_from',
        'valid_to',
        'minimum_order_amount',
        'usage_limit_per_user',
        'usage_count',
        'is_active',
    ];

    protected $sortable = [
        'code'
    ];

    protected $searchable = [
        'code'
    ];

    public function coupon_products() {
        return $this->hasMany(CouponProduct::class);
    }
}
