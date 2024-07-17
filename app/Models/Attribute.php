<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $fillable = [
        'name'
    ];

    public function values()
    {
        return $this->hasMany(AttributeValue::class);
    }
}
