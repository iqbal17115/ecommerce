<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\Category;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
    protected $guarded = [];
    public function Category() {
        return $this->belongsTo(Category::class);
    }
}
