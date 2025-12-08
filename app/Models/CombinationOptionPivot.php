<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinationOptionPivot extends Model
{
     use HasFactory, BaseModel, DisplayNameTrait;

     protected $table = 'combination_option_pivots';

     protected $fillable = [
          'product_combination_id',
          'variant_option_id'
     ];

     public function productCombination()
     {
          return $this->belongsTo(ProductCombination::class);
     }

     public function variantOption()
     {
          return $this->belongsTo(VariantOption::class);
     }
}
