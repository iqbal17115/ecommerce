<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponUserUsage extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'user_id',
        'coupon_id',
        'order_id',
        'product_id'
    ];

    protected $sortable = [
        'coupon_id'
    ];

    protected $searchable = [
        'coupon_id'
    ];
}
