<?php

namespace App\Models\Address;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'user_id',
        'mobile',
        'optional_mobile',
        'street_address',
        'building_name',
        'nearest_landmark',
        'type',
        'is_default',
        'district_id'
    ];
}
