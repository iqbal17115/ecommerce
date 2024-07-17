<?php

namespace App\Models;

use App\Models\Backend\Product\Product;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $fillable = [
        'product_id',
        'price',
        'stock'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function variationAttributeValues(): HasMany
    {
        return $this->hasMany(VariationAttributeValue::class, 'product_variation_id', 'id');
    }
}
