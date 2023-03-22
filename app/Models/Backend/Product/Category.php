<?php

namespace App\Models\Backend\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public function SubCategory() {
        return $this->hasMany(self::class, 'parent_category_id')->orderBy('position', 'ASC');
    }
    public function Parent() {
       return $this->belongsTo(self::class, 'parent_category_id')->orderBy('position', 'ASC');
    }
}