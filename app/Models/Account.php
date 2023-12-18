<?php

namespace App\Models;

use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory, BaseModel, SoftDeletes, DisplayNameTrait;

    protected $table = 'accounts';

    protected $fillable = [
        'account_category_id',
        'parent_account_id',
        'name',
        'code',
        'current_balance',
        'opening_balance',
        'is_bank_account',
        'bank_name',
        'bank_phone',
        'bank_address',
        'is_permanent',
    ];

    protected array $searchable = [
        'name',
        'code',
        'opening_balance',
        'current_balance',
        'bank_name',
        'bank_phone',
        'bank_address',
        'accountCategory.name',
        'accountCategory.account_head',
        'parentAccount.name'
    ];

    protected array $sortable = [
        'account_category' => 'sortAccountCategory',
        'parent_account' => 'sortParentAccount',
        'code' => 'code',
        'name' => 'accounts.name',
        'opening_balance' => 'opening_balance',
        'current_balance' => 'current_balance',
    ];

    protected array $filterable = [
        'account_category_ids' => 'filterByAccountCategory',
        'parent_account_ids' => 'filterByParentAccount'
    ];

    public function accountCategory(): BelongsTo
    {
        return $this->belongsTo(AccountCategory::class, 'account_category_id');
    }

    public function parentAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'parent_account_id');
    }

    public function sortAccountCategory($query, $order): mixed
    {
        return $query
            ->join('account_categories as a_account_category', 'a_account_category.id', '=', 'accounts.account_category_id')
            ->orderBy('a_account_category.name', $order)
            ->select('accounts.*');
    }
}
