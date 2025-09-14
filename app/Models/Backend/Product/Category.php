<?php

namespace App\Models\Backend\Product;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];
    public function Product()
    {
        return $this->hasMany(Product::class);
    }
    
    public function SubCategory() {
        return $this->hasMany(self::class, 'parent_category_id')->orderBy('position', 'ASC');
    }
    public function Parent() {
       return $this->belongsTo(self::class, 'parent_category_id')->orderBy('position', 'ASC');
    }

    public function subcategories()
    {
        return $this->hasMany(self::class, 'parent_category_id')->orderBy('position', 'ASC');
    }

    // Recursive relationship to get all descendants
    public function allSubcategories()
    {
        return $this->subcategories()->with('allSubcategories');
    }

    public function getParentsAttribute()
    {
        $parents = [];
        $category = $this;
        while ($category->Parent) {
            $parents[] = $category->Parent;
            $category = $category->Parent;
        }

        // Reverse the array to have the top-level parent first
        return collect(array_reverse($parents));
    }
}
