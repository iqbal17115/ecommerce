<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\Category;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
    public function Category() {
        return $this->belongsTo(Category::class);
    }
}
