<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
     use HasFactory, BaseModel, DisplayNameTrait;

     protected $table = 'product_specs';

     protected $fillable = [
          'product_id',
          'attribute_name',
          'value'
     ];
}
