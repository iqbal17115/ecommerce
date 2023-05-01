<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\ProductFeature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureSetting extends Model
{
    use HasFactory;
    public function FeatureSettingDetail() {
        return $this->hasMany(FeatureSettingDetail::class);
    }
    public function ProductFeature() {
        return $this->belongsTo(ProductFeature::class);
     }
}
