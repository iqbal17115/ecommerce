<?php

namespace App\Models\Address;

use App\Models\Address\Country;
use App\Models\Address\Division;
use App\Models\Address\District;
use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;

class Address extends Model
{
    use HasApiTokens, HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'user_id',
        'mobile',
        'optional_mobile',
        'street_address',
        'building_name',
        'nearest_landmark',
        'type',
        'is_default',
        'country_id',
        'name',
        'instruction',
        'division_id',
        'district_id',
        'upazila_id'
    ];

    public function userAddressesCount($userId)
    {
        return $this->where('user_id', $userId)->count();
    }
    public function addressInstruction(){
        return $this->hasOne(AddressInstruction::class);
    }

    public function upazila(){
        return $this->belongsTo(Upazila::class);
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
    public function division(){
        return $this->belongsTo(Division::class);
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
