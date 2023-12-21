<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderAddress extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $table = 'order_addresses';

    protected $fillable = [
        'order_id',
        'name',
        'instruction',
        'mobile',
        'optional_mobile',
        'street_address',
        'building_name',
        'nearest_landmark',
        'type',
        'country_name',
        'division_name',
        'district_name',
        'upazila_name'
    ];

}
