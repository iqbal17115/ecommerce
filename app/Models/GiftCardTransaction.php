<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCardTransaction extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'gift_card_id',
        'user_id',
        'order_id',
        'used_amount',
        'balance_after',
        'note'
    ];
}
