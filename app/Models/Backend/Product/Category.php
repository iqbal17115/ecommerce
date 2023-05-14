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
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    // public function parent()
    // {
    //     return $this->belongsTo(Category::class, 'parent_id');
    // }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // public function getNameAttribute()
    // {
    //     $translation = $this->translations->where('locale', app()->getLocale())->first();

    //     return $translation ? $translation->name : null;
    // }

    public function getDescriptionAttribute()
    {
        $translation = $this->translations->where('locale', app()->getLocale())->first();

        return $translation ? $translation->description : null;
    }
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
    public function getParentsAttribute()
    {
        $parents = [];
        $category = $this;
        while ($category->Parent) {
            $parents[] = $category->Parent;
            $category = $category->Parent;
        }
        return collect(array_reverse($parents));
    }
}