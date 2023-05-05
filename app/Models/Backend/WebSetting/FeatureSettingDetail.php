<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureSettingDetail extends Model
{
    use HasFactory;
    public function Category()
    {
        return $this->belongsTo(Category::class)->orderBy('position', 'ASC');;
    }
}
