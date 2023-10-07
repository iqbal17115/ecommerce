<?php

namespace App\Models\Backend\Product;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCompliance extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
}
