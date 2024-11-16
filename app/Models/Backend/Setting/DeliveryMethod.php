<?php

namespace App\Models\Backend\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Backend\Setting\Branch;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DeliveryMethod extends Model
{
    use HasFactory, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];

    public function Branch(){
        return $this->belongsTo(Branch::class);
    }
}
