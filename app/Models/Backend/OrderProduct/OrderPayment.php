<?php

namespace App\Models\Backend\OrderProduct;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPayment extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'order_id',
        'payment_type',
        'payment_method',
        'payment_id',
        'payment_date'
    ];
}
