<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardPointTransaction extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;

    protected $fillable = [
        'user_id',
        'reward_point_rule_id',
        'type',
        'points',
        'description',
    ];
}
