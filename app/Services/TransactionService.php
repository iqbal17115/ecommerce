<?php

namespace App\Services;

use App\Models\Account;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionService
{
    /**
     * Create a new transaction record.
     *
     * @param string $transactionType
     * @param array $requestData
     * @return Transaction
     */
    protected function createTransaction($transactionType, $requestData)
    {
        return Transaction::create([
            'code' => '#' . $transactionType.'-'.uniqid(),
            'date' => Carbon::parse($requestData['date'])->setTime(now()->format('H'), now()->format('i'), now()->format('s')),
            'description' => $requestData['note'],
            'transaction_type' => $transactionType,
        ]);
    }

    /**
     * Update Current Balance
     *
     * @param [type] $account
     * @param [type] $newBalance
     * @return void
     */
   protected function updateCurrentBalance(Account $account, $newBalance)
   {
       $account->update(['current_balance' => $newBalance]);
   }
}
