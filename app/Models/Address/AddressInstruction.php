<?php

namespace App\Models\Address;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressInstruction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'property_type',
        'closed_day_for_delivery',
        'package_leave_address'
    ];
}
