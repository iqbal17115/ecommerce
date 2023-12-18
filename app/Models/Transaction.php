<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'code',
        'date',
        'description',
        'transaction_type'
    ];
}
