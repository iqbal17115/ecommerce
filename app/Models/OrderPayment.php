<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayment extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'order_id',
        'total_order_price',
        'total_discount_amount',
        'total_shipping_charge_amount',
        'total_amount',
        'amount_paid',
        'due_amount',
        'total_receive_amount',
        'payment_status'
    ];

    public function orderPaymentDetails()
    {
        return $this->hasMany(OrderPaymentDetail::class);
    }
}
