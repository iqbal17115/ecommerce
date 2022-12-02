<?php

namespace App\Models\Backend\WebSetting;

use App\Models\Backend\Product\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function Category() {
        return $this->belongsTo(Category::class);
    }
}
