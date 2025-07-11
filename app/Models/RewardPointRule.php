<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardPointRule extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'event',
        'points',
        'multiplier'
    ];
}
