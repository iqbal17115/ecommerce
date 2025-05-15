<?php

namespace App\Models;

use App\Models\Address\Country;
use App\Models\Address\District;
use App\Models\Address\Division;
use App\Models\Address\Upazila;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'user_id',
        'country_id',
        'division_id',
        'district_id',
        'upazila_id',
        'full_name',
        'mobile',
        'optional_mobile',
        'street_address',
        'building_name',
        'nearest_landmark',
        'type',
        'is_default',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
