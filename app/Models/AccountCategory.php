<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AccountCategory extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $table = 'account_categories';

    protected $fillable = [
        'name',
        'account_head',
        'is_permanent'
    ];

    protected array $searchable = [
        'name',
        'account_head'
    ];

    protected array $sortable = [
        'name' => 'name',
        'account_head' => 'account_head'
    ];

    protected array $filterable = [
        'account_heads' => 'filterByAccountHead'
    ];

    protected function filterByAccountHead($query, $value): mixed
    {
        return $query->whereIn('account_head', explode(",", $value));
    }
}
