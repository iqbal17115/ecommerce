<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRewardPoint extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'user_id',
        'total_points',
        'used_points'
    ];
}
