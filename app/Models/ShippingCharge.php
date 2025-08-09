<?php

namespace App\Models;

use App\Models\Address\District;
use App\Models\Address\Division;
use App\Models\Address\Upazila;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingCharge extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait, SoftDeletes;

    protected $table = 'shipping_charges';

    protected $fillable = [
        'division_id',
        'district_id',
        'upazila_id',
        'min_order_amount',
        'max_order_amount',
        'min_weight',
        'max_weight',
        'min_qty',
        'max_qty',
        'charge_amount',
        'is_active'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }
}
