<?php

namespace App\Models\Address;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Division extends Model
{
    use HasFactory, SoftDeletes, BaseModel;

    protected $fillable = [
        'country_id',
        'name',
        'status'
    ];
}
