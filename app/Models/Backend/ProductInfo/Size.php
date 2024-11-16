<?php

namespace App\Models\Backend\ProductInfo;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Size extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];
}
