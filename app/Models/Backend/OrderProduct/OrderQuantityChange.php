<?php

namespace App\Models\Backend\OrderProduct;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderQuantityChange extends Model
{
    use HasFactory, SoftDeletes, BaseModel;
    protected $fillable = [
        'order_detail_id',
        'previous_quantity',
        'new_quantity',
        'change_reason',
        'version'
    ];
}
