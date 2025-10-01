<?php

namespace App\Models;

use App\Models\FrontEnd\Order;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourierShipment extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'order_id',
        'courier_name',
        'tracking_code',
        'consignment_id',
        'status',
        'payload',
        'response',
        'dispatched_at',
        'last_synced_at',
        'delivered_at',
        'is_final',
        'attempts',
        'status_reason'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
