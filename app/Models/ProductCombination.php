<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCombination extends Model
{
     use HasFactory, BaseModel, DisplayNameTrait;

     protected $table = 'product_combinations';

     protected $fillable = [
          'product_id',
          'unique_key',
          'price',
          'special_price',
          'stock',
          'seller_sku',
          'free_items',
          'is_available'
     ];

     public function combinationOptionPivots()
     {
          return $this->hasMany(CombinationOptionPivot::class);
     }
}
