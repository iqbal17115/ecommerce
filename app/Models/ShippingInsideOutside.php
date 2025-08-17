<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShippingInsideOutside extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait, SoftDeletes;

    protected $table = 'shipping_inside_outsides';
    
    protected $fillable = [
        'shipping_zone_id',
        'inside_rate',
        'outside_rate',
    ];

    public function zone()
    {
        return $this->belongsTo(ShippingZone::class, 'shipping_zone_id');
    }
}
