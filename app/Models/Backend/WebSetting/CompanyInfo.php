<?php

namespace App\Models\Backend\WebSetting;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
}
