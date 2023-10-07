<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\ProductFeature;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
    public function Parent() {
        return $this->hasMany(self::class, 'page')->orderBy('position', 'ASC')->pluck('id', 'position');
     }
    public function ProductFeature() {
        return $this->belongsTo(ProductFeature::class);
    }
}
