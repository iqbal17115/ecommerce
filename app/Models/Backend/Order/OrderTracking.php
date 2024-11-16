<?php

namespace App\Models\Backend\Order;

use App\Models\FrontEnd\Order;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderTracking extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'order_id',
        'status',
        'created_by'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
