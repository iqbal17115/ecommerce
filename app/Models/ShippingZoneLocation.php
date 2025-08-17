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

class ShippingZoneLocation extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait, SoftDeletes;

    protected $table = 'shipping_zone_locations';

    protected $fillable = [
        'shipping_zone_id',
        'division_id',
        'district_id',
        'upazila_id',
    ];

    public function shippingZone()
    {
        return $this->belongsTo(ShippingZone::class);
    }

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

    public function getDisplayNameAttribute()
    {
        return $this->shippingZone->name . ' - ' . optional($this->division)->name . ', ' . optional($this->district)->name . ', ' . optional($this->upazila)->name;
    }
}
