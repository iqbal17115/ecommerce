<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class VariationAttributeValue extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $fillable = [
        'product_variation_id',
        'attribute_value_id',
        'group_number',
        'stock',
        'sku',
        'status'
    ];

    public function attributeValue(): BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }
}
