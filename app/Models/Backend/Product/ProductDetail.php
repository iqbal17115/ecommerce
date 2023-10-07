<?php

namespace App\Models\Backend\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Backend\Product\Condition;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;

class ProductDetail extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];
    public function Condition()
    {
        return $this->belongsTo(Condition::class);
    }
}
