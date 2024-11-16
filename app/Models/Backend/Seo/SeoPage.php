<?php

namespace App\Models\Backend\Seo;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SeoPage extends Model
{
    use HasFactory, SoftDeletes, BaseModel;
    protected $fillable = [
        'title',
        'url',
        'image',
        'description',
        'keyword',
        'date',
        'is_image_active',
        'is_icon_active',
        'is_date_active'
    ];
}
