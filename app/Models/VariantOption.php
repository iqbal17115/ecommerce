<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantOption extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $table = 'variant_options';

    protected $fillable = [
        'product_variant_id',
        'option_value',
        'sort_order',
    ];

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
