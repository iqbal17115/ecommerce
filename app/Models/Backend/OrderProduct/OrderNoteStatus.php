<?php

namespace App\Models\Backend\OrderProduct;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderNoteStatus extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'order_id',
        'order_note',
        'order_note_type',
        'payment_status',
        'payment_note',
        'fulfilment_note',
    ];
}
