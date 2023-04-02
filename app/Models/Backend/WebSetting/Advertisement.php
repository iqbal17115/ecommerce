<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\ProductFeature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;
    public function ProductFeature() {
        return $this->belongsTo(ProductFeature::class);
    }
}
