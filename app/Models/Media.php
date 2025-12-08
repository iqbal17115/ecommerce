<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';

    protected $fillable = [
        'mediable_id',
        'mediable_type',
        'type',
        'path',
        'video_source',
        'meta',
        'sort_order',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    public function mediable()
    {
        return $this->morphTo();
    }
}
