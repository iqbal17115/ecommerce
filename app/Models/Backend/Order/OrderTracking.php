<?php

namespace App\Models\Backend\Order;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTracking extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'order_id',
        'status',
        'created_by'
    ];
}
