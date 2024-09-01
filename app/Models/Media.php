<?php

namespace App\Models;

use App\Traits\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, BaseModel, SoftDeletes;

    protected $table = 'medias';

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'file_path',
        'mime_type',
        'type',
        'file_size',
    ];

    public function mediable(): MorphTo
    {
        return $this->morphTo();
    }
}
