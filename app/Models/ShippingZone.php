<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingZone extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait, SoftDeletes;

    protected $table = 'shipping_zones';

    protected $fillable = [
        'name',
        'type',
        'is_active',
    ];

    public function rates()
    {
        return $this->hasMany(ShippingRate::class, 'shipping_zone_id');
    }

    public function insideOutside()
    {
        return $this->hasOne(ShippingInsideOutside::class, 'shipping_zone_id');
    }
}
