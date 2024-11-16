<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductColor extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'product_id',
        'attribute_value_id'
    ];

    public function attributeValue(): BelongsTo
    {
        return $this->belongsTo(AttributeValue::class);
    }

    public function productVariations()
    {
        // Assuming product variations are filtered by color
        return $this->hasMany(ProductVariation::class, 'product_id', 'product_id')
            ->whereHas('productVariationAttributes', function ($query) {
                $query->where('attribute_value_id', $this->attribute_value_id); // Color filter
            });
    }

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
