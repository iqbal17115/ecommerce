<?php

namespace App\Models\FrontEnd;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function parent()
    {
        return $this->belongsTo(Review::class, 'parent_id');
    }
}
