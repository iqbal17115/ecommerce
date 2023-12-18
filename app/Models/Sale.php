<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'invoice_no',
        'order_id',
        'user_id',
        'date',
        'total_amount',
        'discount',
        'shipping_charge',
        'vat',
        'payable_amount',
        'note',
        'invoice_channel',
        'coupon_code_id'
    ];
}
