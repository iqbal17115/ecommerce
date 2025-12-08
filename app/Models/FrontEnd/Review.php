<?php

namespace App\Models\FrontEnd;

use App\Models\User;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory, BaseModel, DisplayNameTrait;
    protected $fillable = ['user_id', 'product_id', 'rating', 'comment', 'status', 'parent_id'];
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
