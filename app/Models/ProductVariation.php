<?php

namespace App\Models;

use App\Models\Backend\Product\Product;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductVariation extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'product_id',
        'price',
        'sku',
        'stock',
        'status'
    ];

    public function product(): BelongsTo
    {
       return $this->belongsTo(Product::class);
    }

    public function productVariationAttributes(): HasMany
    {
        return $this->hasMany(ProductVariationAttribute::class);
    }
}
