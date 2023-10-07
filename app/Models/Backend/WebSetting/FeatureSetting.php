<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\ProductFeature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\WebSetting\FeatureSettingDetail;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Model;

class FeatureSetting extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
    public function FeatureSettingDetail() {
        return $this->hasMany(FeatureSettingDetail::class);
    }
    public function ProductFeature() {
        return $this->belongsTo(ProductFeature::class);
     }
}
