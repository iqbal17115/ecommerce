<?php

namespace App\Models\Backend\OrderProduct;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProductCancelReturn extends Model
{
    use HasFactory, SoftDeletes, BaseModel;
}
