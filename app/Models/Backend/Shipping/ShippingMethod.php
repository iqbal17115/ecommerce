<?php

namespace App\Models\Backend\Shipping;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingMethod extends Model
{
    use HasFactory, BaseModel;
    protected $fillable = ['name', 'type', 'value', 'is_active'];

    // Define the types for the select option
    const TYPE_PERCENT = 'percent';
    const TYPE_AMOUNT = 'amount';

    // Define the scope to filter records by name
    public function scopeWithName($query, $name)
    {
        return $query->where('name', $name);
    }
}
