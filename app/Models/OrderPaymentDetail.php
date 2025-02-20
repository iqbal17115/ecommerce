<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderPaymentDetail extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'order_payment_id',
        'date',
        'payment_type',
        'payment_method',
        'amount',
        'card_number',
        'transaction_number',
        'bank_name',
        'cheque_number',
        'note',
        'is_successful'
    ];
}
