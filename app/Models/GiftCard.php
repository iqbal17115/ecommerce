<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'code',
        'amount',
        'balance',
        'recipient_email',
        'sender_name',
        'message',
        'status',
        'expiration_date',
        'status'
    ];
}
