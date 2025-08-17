<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingRate extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait, SoftDeletes;

    protected $table = 'shipping_rates';

    protected $fillable = [
        'shipping_zone_id',
        'min_weight',
        'max_weight',
        'min_amount',
        'max_amount',
        'rate',
    ];

    public function zone()
    {
        return $this->belongsTo(ShippingZone::class, 'shipping_zone_id');
    }
}
