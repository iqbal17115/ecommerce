<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
     use HasFactory, BaseModel, DisplayNameTrait;

     protected $table = 'product_variants';

     protected $fillable = [
          'product_id',
          'name',
          'is_image_variant',
          'sort_order'
     ];

     public function variantOptions()
     {
          return $this->hasMany(VariantOption::class);
     }
}
