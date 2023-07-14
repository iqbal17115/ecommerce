<?php

namespace App\Models\Backend\Shipping;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    use HasFactory, BaseModel;
    protected $fillable = [
        'shipping_method_id',
        'shipping_class_id',
        'length',
        'width',
        'height',
        'weight',
        'charge',
        'min_quantity',
        'max_quantity',
        'area',
        'min_amount',
        'max_amount',
        'free_shipping',
        'minimum_amount_for_free_shipping',
        'maximum_amount_for_free_shipping',
    ];

}
